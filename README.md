# 📦 Ürün Yönetim Sistemi (PHP & CodeIgniter 3)

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

Ürün işlemleri 4 ana sekme üzerinden yönetilmektedir:

1. **Genel:** Ürün adı, temel bilgiler
2. **Detaylar:** Açıklama ve ek bilgiler
3. **Resimler:** Ürüne ait birden fazla görsel yükleme
4. **İndirim:** Ürüne özel indirim oranı tanımlama

Bu yapı, hem kullanıcı deneyimini iyileştirmek hem de kod tarafında modülerliği artırmak amacıyla tercih edilmiştir.

---

## 🧠 Varsayımlar ve Tasarım Kararları

Proje geliştirilirken bazı bilinçli varsayımlar yapılmıştır:

* Yönetim panelini kullanan kişinin **admin** olduğu varsayılmıştır.
* Ürün ekleme ve düzenleme ekranlarında bulunan sekmelerin tamamı, kullanıcının ürünü adım adım girdiği varsayımıyla tasarlanmıştır.
* Aynı ürüne birden fazla görsel eklenebileceği varsayılmış ve bu doğrultuda ayrı bir ürün–resim tablosu oluşturulmuştur.
* Proje kapsamı gereği stok yönetimi ve sipariş süreçleri bilinçli olarak dışarıda bırakılmıştır.
* İndirim panelinde bulunan **kaldır** işlemi geçerli indirimlerin silinmesi olarak varsayılmıştır.

---

## 🗄️ Veritabanı Şeması

Proje ilişkisel veritabanı mantığıyla tasarlanmıştır. Temel tablolar aşağıdaki gibidir:

```
products
--------
id (PK)
name
description
price
created_at
updated_at

product_images
--------------
id (PK)
product_id (FK)
image_path

product_discounts
-----------------
id (PK)
product_id (FK)
discount_rate
created_at
```

---

## 🔗 Tablolar Arası İlişkiler

* **products → product_images**

  * Bir ürünün birden fazla görseli olabilir.
  * Bu ilişki *One‑to‑Many* şeklindedir.
  * Görseller ayrı tabloda tutularak veri tekrarı önlenmiştir.

* **products → product_discounts**

  * Her ürün için opsiyonel bir indirim tanımlanabilir.
  * İndirim bilgileri ürün tablosundan ayrılarak daha esnek bir yapı sağlanmıştır.

Bu ilişkiler, ileride kampanya ve galeri yapılarının genişletilmesine olanak tanıyacak şekilde tasarlanmıştır.

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
* Stok ve sipariş yönetimi
* API tabanlı mimariye geçiş
* Frontend için React veya Vue entegrasyonu
* Birim ve entegrasyon testleri

eklenebilir.

---

## 📌 Sonuç

Bu proje, ürün yönetimi gibi kritik bir iş sürecini sade, anlaşılır ve geliştirilebilir bir mimariyle ele almaktadır. İş teklifine yönelik olarak geliştirilmiş olması sebebiyle, yalnızca çalışan bir sistem değil; **tasarım kararları, varsayımlar ve genişleme potansiyeli** de göz önünde bulundurularak hazırlanmıştır.

---

## 📄 Lisans

Bu proje MIT lisansı ile lisanslanmıştır.
