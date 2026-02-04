# 📦 Ürün Yönetim Sistemi (PHP 7.4 & CodeIgniter 3)

Bu proje, bir e‑ticaret altyapısının en kritik bileşenlerinden biri olan **ürün yönetim sürecini** kapsayan ve PHP 7.0+ ve **CodeIgniter 3** kullanılarak geliştirilmiş modüler bir yönetim panelidir. 

Amaç ürünlerin **oluşturulması, düzenlenmesi, listelenmesi**, ürünlere **çoklu görsel eklenmesi** ve **dinamik indirim tanımlanması** gibi süreçleri sade, anlaşılır ve genişletilebilir bir yapı içerisinde sunmaktır.

---

## 🎯 Projenin Amacı

Bu projenin temel amacı, bir firmanın ürünlerini tek bir merkezden yönetebileceği, geliştirilmeye açık ve ölçeklenebilir bir ürün yönetim altyapısı oluşturmaktır. Özellikle:

* Ürün bilgilerinin merkezi olarak yönetilmesi
* Ürünlere birden fazla görsel atanabilmesi
* İndirim oranlarının esnek şekilde tanımlanabilmesi
* Yönetim paneli mantığının sade ve anlaşılır olması
* Ürünlerin ve indirimlerin listenebilmesi

hedeflenmiştir. Proje, gerçek hayat senaryoları göz önünde bulundurularak geliştirilmiştir.

---

## 🧱 Uygulama Yapısı

Uygulama, **MVC (Model–View–Controller)** mimarisine uygun olarak geliştirilmiştir:

* **Controllers:** İş akışının yönetildiği katman
* **Models:** Veritabanı işlemlerinin gerçekleştirildiği katman
* **Views:** Kullanıcı arayüzünün oluşturulduğu katman
* Okunabilirliği artırmak ve Fat Controller'dan kaçınmak için Model katmanına business logic'i içeren service katmanı eklenmiştir.

Ürün işlemleri 4 ana sekme üzerinden yönetilmektedir:

1. **Genel:** Ürün başlığı, açıklaması, seo adresi, meta başlığı ve video embed kodu
2. **Detaylar:** Ürüne ait fiyat, vergi oranı, adet, sepet indirim bilgisi, birincil ve ikincil satış fiyatları, stok durumu, geçerlilik ve garanti süresi bilgileri
3. **Resimler:** Ürüne ait birden fazla görsel yükleme ve resimlerin görüntülenmesi
4. **İndirim:** Ürüne ve müşteri türüne özel indirim oranı tanımlama, tarih aralığı girme, öncelik belirleme 

Bu yapı, hem kullanıcı deneyimini iyileştirmek hem de kod tarafında modülerliği artırmak amacıyla tercih edilmiştir.

---

## 🧠 Varsayımlar ve Tasarım Kararları

Proje geliştirilirken bazı bilinçli varsayımlar yapılmıştır:

* Yönetim panelini kullanan kişinin **admin** olduğu varsayılmıştır.
* Ürün ekleme ve düzenleme ekranlarında bulunan sekmelerin tamamı, kullanıcının ürünü adım adım girdiği varsayımıyla tasarlanmıştır.
* Aynı ürüne birden fazla görsel eklenebileceği varsayılmış ve bu doğrultuda ayrı bir ürün–resim tablosu oluşturulmuştur.
* Proje kapsamı gereği stok yönetimi ve sipariş süreçleri bilinçli olarak dışarıda bırakılmıştır.
* İndirim panelinde bulunan **kaldır** işlemi geçerli indirimlerin silinmesi olarak varsayılmıştır.
* Aynı müşteri grubuna farklı tarih aralıklarında birden fazla kampanya tanımlanabilmesi için product_id ve customer_group alanlarında unique constraint uygulanmamıştır.

---

## 🗄️ Veritabanı Şeması

Proje ilişkisel veritabanı mantığıyla tasarlanmıştır. Temel tablolar aşağıdaki gibidir:
<p align="center">
  <img src="https://github.com/oykunsay/CI3-Urun-Yonetimi/blob/main/product_db.png?raw=true" width="600" alt="Database Schema">
</p>

---

## 🔗 Tablolar Arası İlişkiler

* **products**
 * Ana ürün tablosudur. Ürüne ait stok bilgileri, vergi oranı, durum bilgileri, ana görsel, yeni ürün flag’i, taksit ve garanti gibi operasyonel alanlar bu tabloda tutulur. Ürünle ilgili diğer tüm tablolar bu tabloya `product_id` üzerinden bağlanır.

* **products → product_discounts**
  * Ürünlere uygulanabilecek müşteri grubu bazlı veya tarih aralıklı indirimleri tutar. İndirimler tutar veya yüzde bazlı olabilir. Öncelik ve geçerlilik tarihleri sayesinde birden fazla indirim senaryosu desteklenir.
- İlişki: `products (1) → product_discounts (N)`

* **products → product_descriptions**
  * Ürünlerin çoklu dil desteğini sağlamak amacıyla oluşturulmuştur. Her ürün için farklı language_code değerleri ile başlık, açıklama, SEO alanları ve video embed kodu tutulabilir. Bu yapı sayesinde tek bir ürün birden fazla dilde içerik sunabilir.
- İlişki: `products (1) → product_descriptions (N)`

* **products → product_prices**
  * Ürünlerin para birimi bazlı fiyatlarını tutmak için tasarlanmıştır. Aynı ürün için TL, USD ve EUR gibi farklı para birimlerinde fiyat tanımlanabilir. Ayrıca `price_type` alanı ile birincil ve ikincil satış fiyatları ayrıştırılmıştır.
- İlişki: `products (1) → product_prices (N)`

* **product → product_images**
  * Ürünlere ait birden fazla görselin yönetilmesini sağlar. `sort_order` alanı ile görsellerin sıralaması kontrol edilir. Ana görsel bilgisi products tablosunda tutulurken, galeri görselleri bu tabloda saklanır.  
- İlişki: `products (1) → product_images (N)`
---

## 🚀 Kurulum

1. Projeyi klonlayın:

   ```bash
   git clone https://github.com/oykunsay/CI3-Urun-Yonetimi.git
   ```
2. Veritabanı dosyasını MySQL üzerine import edin.
3. `application/config/database.php` dosyasından veritabanı ayarlarını düzenleyin.
4. Projeyi bir Apache veya Nginx sunucu üzerinde çalıştırın.

---

## 🔧 Geliştirilebilir Alanlar

Proje geliştirmeye açık olacak şekilde tasarlanmıştır. İleride:

* Rol bazlı yetkilendirme sistemi
* Ürün detayları için ürün bazlı detay sayfası
* History tablosu aracılığıyla kimlerin değişiklik yaptığını görebilme
* Listede arama
* Ürünler üzerinde filtreleme özellikleri
* Birim ve entegrasyon testleri
* Hata durumunda eski versiyonlara recover edebilme
* Resimlerin veritabanından çekilmesi yerine ayrı bir sunucuda tutulması
eklenebilir.

---

## 📌 Sonuç

Bu proje ürün yönetimi ve indirimleri gibi kritik bir iş sürecini sade, anlaşılır ve geliştirilebilir bir mimariyle ele almaktadır.

