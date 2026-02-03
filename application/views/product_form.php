<?php if (validation_errors()): ?>
    <div style="background: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
        <strong>Hataları düzeltin:</strong>
        <?php echo validation_errors(); ?>
    </div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Yönetimi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-size: 14px;
        }

        .nav-tabs .nav-link {
            color: #495057;
            border-radius: 0;
        }

        .card {
            border-radius: 0;
            border: 1px solid #dee2e6;
        }

        .form-control, .form-select {
            border-radius: 0;
            border: 1px solid #ced4da;
        }

        .col-form-label {
            font-weight: 500;
        }

        <
        /
        small >
    </style>
</head>
<body>

<div class="container-fluid mt-4">
    <form id="productForm" action="<?= site_url('product/save') ?>"
          method="POST"
          enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= isset($product) ? $product->id : '' ?>">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0"><?= isset($product) ? 'Ürün Düzenle' : 'Yeni Ürün' ?></h5>
            <div>
                <button type="submit" class="btn btn-outline-success btn-sm bg-white px-3">
                    <i class="fa fa-save text-success"></i> <span class="text-dark">Kaydet</span>
                </button>
                <a href="<?= base_url('index.php/product/list_all') ?>"
                   class="btn btn-outline-danger btn-sm rounded-0 px-4">İptal</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-white p-0">
                <ul class="nav nav-tabs border-bottom-0" id="productTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active px-4" data-bs-toggle="tab"
                                            href="#tab-genel">Genel</a></li>
                    <li class="nav-item"><a class="nav-link px-4" data-bs-toggle="tab" href="#tab-detaylar">Detaylar</a>
                    </li>
                    <li class="nav-item"><a class="nav-link px-4" data-bs-toggle="tab" href="#tab-resimler">Resimler</a>
                    </li>
                    <li class="nav-item"><a class="nav-link px-4" data-bs-toggle="tab" href="#tab-indirim">İndirim</a>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4">
                <div class="tab-content" id="productTabContent">

                    <div class="tab-pane fade show active border p-4 bg-white" id="tab-genel" role="tabpanel">

                        <div class="mb-4 border-bottom pb-2">
        <span class="badge border text-dark p-2" style="background:#fff">
            <img src="https://flagcdn.com/16x12/tr.png" class="me-1" alt=""> Türkçe
        </span>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label"><span class="text-danger">*</span> Türkçe Ürün Başlık</label>
                            <div class="col-sm-10">
                                <label>
                                    <input type="text" name="title" class="form-control rounded-0"
                                           value="<?= isset($product) ? $product->title : '' ?>">
                                </label>

                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Türkçe Ürün Ek Bilgi Başlığı</label>
                            <div class="col-sm-10">
                                <label>
                                    <input type="text" name="sub_title" class="form-control rounded-0"
                                           value="<?= isset($product) ? $product->sub_title : '' ?>">
                                </label>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Türkçe Ürün Ek Bilgi Açıklaması</label>
                            <div class="col-sm-10">
                                <input type="text" name="sub_description" class="form-control rounded-0"
                                       value="<?= isset($product) ? $product->sub_description : '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Türkçe Meta Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="meta_title" class="form-control rounded-0"
                                       value="<?= isset($product) ? $product->meta_title : '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Türkçe Meta Keywords</label>
                            <div class="col-sm-10">
                                <input type="text" name="meta_keywords" class="form-control rounded-0"
                                       value="<?= isset($product) ? $product->meta_keywords : '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label class="col-sm-2 col-form-label">Türkçe Meta Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="meta_description" class="form-control rounded-0"
                                       value="<?= isset($product) ? $product->meta_description : '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">
                                Türkçe Seo Adresi<br>
                                <small class="text-muted" style="font-size: 10px; line-height: 1.2; display: block;">
                                    Seo adresi girilmesi zorunlu değildir, girilen seo adresi geçerli olur. Girilmez ise
                                    otomatik olarak Başlık kısmını referans alarak oluşturulur.
                                </small>
                            </label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <input type="text" name="seo_url" class="form-control rounded-0"
                                       value="<?= isset($product) ? $product->seo_url : '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-sm-2 col-form-label">Türkçe Ürün Açıklama</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="editor_tr"
                                          class="ckeditor"><?= isset($product) ? $product->description : '' ?></textarea>
                            </div>
                        </div>

                        <hr class="my-4" style="border-top: 1px solid #eee;">

                        <div class="row mb-3 d-flex align-items-center">
                            <label class="col-sm-2 col-form-label">
                                Türkçe Video Embed Kodu<br>
                                <small class="text-muted"
                                       style="font-size: 10px; line-height: 1.2; display: block; font-weight: normal;">
                                    Vimeo - Google Video - Youtube tarzı video sitelerinin embed kodu.
                                </small>
                            </label>
                            <div class="col-sm-10">
    <textarea name="video_embed" class="form-control rounded-0" rows="4"
              style="border: 1px solid #ccc;"><?= isset($product) ? $product->video_embed_code : '' ?></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade p-4 bg-white" id="tab-detaylar" role="tabpanel">

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">
                                <span class="text-danger">*</span> Ürün Kodu<br>
                                <small class="text-muted" style="font-size: 10px;">Ürünün kodu.</small>
                            </label>
                            <div class="col-sm-5">
                                <input type="text" name="product_code" class="form-control rounded-0"
                                       value="<?= isset($product) ? $product->product_code : '' ?>">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">
                                <span class="text-danger">*</span> Miktar<br>
                                <small class="text-muted" style="font-size: 10px; line-height: 1.2; display: block;">
                                    Üründen kaç adet olacağını belirler. Bu miktar 0 olarak girilirse sitede "stokta
                                    yok" ibareleriyle listelenecektir. Eğer üründe seçenek varsa seçeneklerin stoğu ürün
                                    stoğundan büyük olamaz.
                                </small>
                            </label>
                            <div class="col-sm-5 d-flex align-items-start">
                                <input type="number" name="stock" class="form-control rounded-0 me-2"
                                       value="<?= isset($product) ? $product->stock_amount : '0' ?>"
                                       style="width: 120px;">
                                <select class="form-select rounded-0 text-muted bg-light" disabled>
                                    <option>Adet</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">
                                <span class="text-danger">*</span> Sepet Ekstra İndirim %:<br>
                                <small class="text-muted" style="font-size: 10px; line-height: 1.2; display: block;">
                                    Ürün sepet ekstra indirimde seçeneklere fiyat girilmiş ise indirim seçenek
                                    fiyatlarına da uygulanmaktadır.
                                </small>
                            </label>
                            <div class="col-sm-2">
                                <select name="extra_discount" class="form-select rounded-0">
                                    <option value="0" <?= (isset($product) && $product->extra_discount_percent == "0") ? 'selected' : '' ?>>
                                        0
                                    </option>
                                    <option value="10" <?= (isset($product) && $product->extra_discount_percent == "10") ? 'selected' : '' ?>>
                                        10
                                    </option>
                                    <option value="20" <?= (isset($product) && $product->extra_discount_percent == "20") ? 'selected' : '' ?>>
                                        20
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4 border-bottom pb-4">
                            <label class="col-sm-3 col-form-label">
                                <span class="text-danger">*</span> Vergi Oranı %<br>
                                <small class="text-muted" style="font-size: 10px;">Ürünün vergi oranı.</small>
                            </label>
                            <div class="col-sm-5">
                                <select name="tax_rate" class="form-select rounded-0 bg-light" disabled>
                                    <option value="18">18</option>
                                </select>
                            </div>
                        </div>

                        <div class="bg-light border-top border-bottom mb-4"
                             style="margin-left: -24px; margin-right: -24px; padding-left: 24px; padding-right: 24px;">

                            <div class="row align-items-center py-3">
                                <label class="col-sm-3 col-form-label">
                                    <span class="text-danger">*</span> Satış Fiyatı<br>
                                    <small class="text-muted" style="font-size: 10px;">Ürünün satış fiyatı.</small>
                                </label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="text" name="price_tl" class="form-control rounded-0"
                                               value="<?= isset($product) ? $product->price_tl : '' ?>">
                                        <span class="input-group-text bg-white rounded-0">TL</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col-sm-2 offset-sm-3">
                                    <div class="input-group">
                                        <input type="text" name="price_usd" class="form-control rounded-0"
                                               value="<?= isset($product) ? $product->price_usd : '' ?>">
                                        <span class="input-group-text bg-white rounded-0">$</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col-sm-2 offset-sm-3">
                                    <div class="input-group">
                                        <input type="text" name="price_eur" class="form-control rounded-0"
                                               value="<?= isset($product) ? $product->price_eur : '' ?>">
                                        <span class="input-group-text bg-white rounded-0">€</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-light border-top border-bottom mb-4"
                             style="margin-left: -24px; margin-right: -24px; padding-left: 24px; padding-right: 24px;">
                            <div class="row align-items-center py-3">
                                <label class="col-sm-3 col-form-label">
                                    <span class="text-danger">*</span> 2. Satış Fiyatı
                                </label>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <input type="text" name="price_2_tl" class="form-control rounded-0"
                                               value="<?= isset($product) ? $product->second_price : '' ?>">
                                        <span class="input-group-text bg-white rounded-0">TL</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">
                                <span class="text-danger">*</span> Stoktan Düş<br>
                                <small class="text-muted" style="font-size: 10px;">Ürün satıldıktan sonra ürün miktarı
                                    eksilir.</small>
                            </label>
                            <div class="col-sm-5">
                                <label>
                                    <select class="form-select rounded-0 bg-light" disabled>
                                        <option value="1" selected>- Evet -</option>
                                    </select>
                                </label>
                                <input type="hidden" name="subtract_stock" value="1">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">
                                <span class="text-danger">*</span> Durum<br>
                                <small class="text-muted" style="font-size: 10px;">Ürünleri aktif ya da pasif
                                    edin.</small>
                            </label>
                            <div class="col-sm-5"><select name="status" class="form-select rounded-0 bg-light">
                                    <option value="1" <?= (isset($product) && $product->status == 1) ? 'selected' : '' ?>>
                                        Aktif
                                    </option>
                                    <option value="0" <?= (isset($product) && $product->status == 0) ? 'selected' : '' ?>>
                                        Pasif
                                    </option>
                                </select></div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">
                                <span class="text-danger">*</span> Özellik Bölümü<br>
                                <small class="text-muted" style="font-size: 10px;">Ürünlerin özellik tabını gösterin
                                    ya da göstermeyin.</small>
                            </label>
                            <div class="col-sm-5"><select name="show_features" class="form-select rounded-0 bg-light"
                                >
                                    <option value="1" <?= (isset($product) && $product->show_features == "1") ? 'selected' : '' ?>>
                                        - Göster -
                                    </option>
                                    <option value="0" <?= (isset($product) && $product->show_features == "0") ? 'selected' : '' ?>>
                                        - Gösterme -
                                    </option>
                                </select></div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label"><span class="text-danger">*</span> Yeni Ürün
                                geçerlilik süresi</label>
                            <div class="col-sm-5"><input type="date" name="new_valid_until"
                                                         class="form-control rounded-0" value="2026-08-12"></div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label"><span class="text-danger">*</span> Sıralama</label>
                            <div class="col-sm-5"><input type="number" name="sort_order" class="form-control rounded-0"
                                                         value="<?= (isset($product) && isset($product->sort_order)) ? $product->sort_order : '0' ?>">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label">
                                <span class="text-danger">*</span> Anasayfada Göster<br>
                                <small class="text-muted" style="font-size: 10px; line-height: 1.2; display: block;">
                                    Anasayfa sırasını ayarlamak için sayı giriniz! 0'dan büyük sayı girerseniz
                                    anasayfada gösterir ve o sırayı alır. 0 girerseniz anasayfada gözükmez.
                                </small>
                            </label>
                            <div class="col-sm-5">
                                <input type="number" name="show_on_homepage" class="form-control rounded-0"
                                       value="<?= (isset($product) && isset($product->show_on_homepage)) ? $product->show_on_homepage : '0' ?>">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label"><span class="text-danger">*</span> Yeni Ürün</label>
                            <div class="col-sm-5">
                                <select name="is_new" class="form-select rounded-0 bg-light">
                                    <option value="1" <?= (isset($product) && $product->is_new == "1") ? 'selected' : '' ?>>
                                        - Evet -
                                    </option>
                                    <option value="0" <?= (isset($product) && $product->is_new == "0") ? 'selected' : '' ?>>
                                        - Hayır -
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label class="col-sm-3 col-form-label"><span class="text-danger">*</span> Taksit</label>
                            <div class="col-sm-5">
                                <select name="allow_installments" class="form-select rounded-0 bg-light">
                                    <option value="1" <?= (isset($product) && $product->allow_installments == "1") ? 'selected' : '' ?>>
                                        - Evet -
                                    </option>
                                    <option value="0" <?= (isset($product) && $product->allow_installments == "0") ? 'selected' : '' ?>>
                                        - Hayır -
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">
                                Garanti Süresi<br>
                                <small class="text-muted" style="font-size: 10px;">Ürün için verilen ay cinsinden
                                    garanti süresi</small>
                            </label>
                            <div class="col-sm-5">
                                <input type="text" name="warranty" class="form-control rounded-0"
                                       value="<?= (isset($product) && isset($product->warranty_period)) ? $product->warranty_period : '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade p-4 bg-white" id="tab-resimler" role="tabpanel">


                        <div class="row align-items-start mb-5">

                            <div class="col-sm-3">

                                <label class="fw-bold d-block mb-1">Ürün Ana Resmi</label>

                                <small class="text-muted d-block" style="font-size: 11px; line-height: 1.4;">

                                    Ürüne ana resim eklemek için tıklayın.<br>

                                    Ürün resim eklerken kare resim girmelisiniz, önerilen boyut 800px genişlik, 800px
                                    yükseklik.<br>

                                    Ürün resim eklerken maksimum resim boyutu 1MB ve genişlik 768px, yükseklik 1024px
                                    olmalıdır.

                                </small>

                            </div>


                            <div class="col-sm-9">

                                <div class="d-inline-block text-center">

                                    <div class="border p-2 bg-light mb-2"
                                         style="width: 120px; height: 120px; cursor: pointer;" id="main_image_area">

                                        <img src="<?= (isset($product->main_image) && !empty($product->main_image))
                                                ? base_url('uploads/products/' . $product->main_image)
                                                : base_url('images/camera.png'); ?>"
                                             id="main_preview"
                                             class="img-fluid"
                                             style="width: 100%; height: 100%; object-fit: cover;" alt="">

                                        <input type="file" name="main_image" id="main_file" class="d-none"
                                               accept="image/*">

                                    </div>

                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-0 px-3"
                                            style="font-size: 12px;" onclick="clearImage()">

                                        Temizle

                                    </button>

                                </div>

                            </div>

                        </div>


                        <hr class="mb-4">


                        <input type="file" name="additional_images[]" id="additional_images_input" class="d-none"
                               multiple accept="image/*">

                        <div class="row">
                            <div class="col-sm-3">
                                <label class="fw-bold">Resimler</label>
                            </div>
                            <div class="col-sm-9 border-top pt-3">
                                <div class="row mb-3" id="additional_preview_area">
                                    <?php if (isset($product_images) && !empty($product_images)): ?>
                                        <?php foreach ($product_images as $image): ?>
                                            <div class="col-sm-3 mb-3 text-center position-relative">
                                                <img src="<?= base_url('uploads/products/' . $image->image_path) ?>"
                                                     class="img-thumbnail rounded-0"
                                                     style="width: 100%; height: 120px; object-fit: cover;">
                                                <button type="button"
                                                        class="btn btn-danger btn-sm rounded-0 position-absolute top-0 end-0"
                                                        onclick="deleteImage(<?= $image->id ?>)">
                                                    <i class="fa fa-times text-white"></i>
                                                </button>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                                <hr>
                                <button type="button" class="btn btn-outline-success btn-sm rounded-0 px-3"
                                        onclick="document.getElementById('additional_images_input').click();">
                                    <i class="fa fa-plus"></i> Yeni Ek Resim Ekle
                                </button>
                            </div>
                        </div>
                    </div>


                    <script>

                        document.getElementById('main_image_area').addEventListener('click', function () {

                            document.getElementById('main_file').click();

                        });


                        document.getElementById('main_file').addEventListener('change', function () {

                            const file = this.files[0];

                            if (file) {

                                const reader = new FileReader();

                                reader.onload = function (e) {

                                    document.getElementById('main_preview').src = e.target.result;

                                }

                                reader.readAsDataURL(file);

                            }

                        });


                        function clearImage() {
                            document.getElementById('main_preview').src = '<?php echo base_url("images/camera.png"); ?>';
                            document.getElementById('main_file').value = "";
                        }

                    </script>
                    <div class="tab-pane fade p-4 bg-white" id="tab-indirim" role="tabpanel">
                        <table class="table table-bordered align-middle text-center" id="discount_table">
                            <thead class="table-light">
                            <tr class="small text-dark fw-bold">
                                <th>Müşteri Grubu</th>
                                <th>Öncelik</th>
                                <th>İndirim Değerleri (TL / $ / €)</th>
                                <th>Tür</th>
                                <th>Başlangıç / Bitiş Tarihi</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody id="discount_table_body">
                            <?php if (!empty($product_discounts)): ?>
                                <?php foreach ($product_discounts as $key => $discount): ?>
                                    <tr>
                                        <td style="width: 15%;">
                                            <select name="discount[<?= $key ?>][customer_group]" class="form-select rounded-0" style="font-size: 13px;">
                                                <option value="Müşteri" <?= ($discount->customer_group == 'Müşteri') ? 'selected' : '' ?>>Müşteri</option>
                                                <option value="VIP" <?= ($discount->customer_group == 'VIP') ? 'selected' : '' ?>>VIP</option>
                                            </select>
                                        </td>
                                        <td style="width: 10%;">
                                            <input type="number" name="discount[<?= $key ?>][priority]" class="form-control text-center rounded-0" value="<?= $discount->priority ?>" style="font-size: 13px;">
                                        </td>
                                        <td style="width: 25%;">
                                            <div class="input-group input-group-sm mb-1">
                                                <span class="input-group-text bg-light" style="width: 35px;">TL</span>
                                                <input type="text" name="discount[<?= $key ?>][price_tl]" class="form-control rounded-0"
                                                       value="<?= ($discount->currency == 'TL') ? number_format($discount->discount_value, 2, '.', '') : '' ?>">
                                            </div>
                                            <div class="input-group input-group-sm mb-1">
                                                <span class="input-group-text bg-light" style="width: 35px;">$</span>
                                                <input type="text" name="discount[<?= $key ?>][price_usd]" class="form-control rounded-0"
                                                       value="<?= ($discount->currency == 'USD') ? number_format($discount->discount_value, 2, '.', '') : '' ?>">
                                            </div>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-light" style="width: 35px;">€</span>
                                                <input type="text" name="discount[<?= $key ?>][price_eur]" class="form-control rounded-0"
                                                       value="<?= ($discount->currency == 'EUR') ? number_format($discount->discount_value, 2, '.', '') : '' ?>">
                                            </div>
                                        </td>
                                        <td style="width: 12%;">
                                            <select name="discount[<?= $key ?>][type]" class="form-select rounded-0" style="font-size: 13px;">
                                                <option value="price" <?= ($discount->type == 'price') ? 'selected' : '' ?>>İndirimli Fiyat</option>
                                                <option value="percentage" <?= ($discount->type == 'percentage') ? 'selected' : '' ?>>Yüzde (%)</option>
                                            </select>
                                        </td>
                                        <td style="width: 20%;">
                                            <input type="date" name="discount[<?= $key ?>][start_date]" class="form-control form-control-sm rounded-0 mb-1" value="<?= $discount->start_date ?>" style="font-size: 12px;">
                                            <input type="date" name="discount[<?= $key ?>][end_date]" class="form-control form-control-sm rounded-0" value="<?= $discount->end_date ?>" style="font-size: 12px;">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm rounded-0 remove-discount">Kaldır</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td style="width: 15%;">
                                        <select name="discount[0][customer_group]" class="form-select rounded-0" style="font-size: 13px;">
                                            <option value="Müşteri">Müşteri</option>
                                            <option value="VIP">VIP</option>
                                        </select>
                                    </td>
                                    <td style="width: 10%;">
                                        <input type="number" name="discount[0][priority]" class="form-control text-center rounded-0" value="1" style="font-size: 13px;">
                                    </td>
                                    <td style="width: 25%;">
                                        <div class="input-group input-group-sm mb-1">
                                            <span class="input-group-text bg-light" style="width: 35px;">TL</span>
                                            <input type="text" name="discount[0][price_tl]" class="form-control rounded-0" placeholder="0.00" value="">
                                        </div>
                                        <div class="input-group input-group-sm mb-1">
                                            <span class="input-group-text bg-light" style="width: 35px;">$</span>
                                            <input type="text" name="discount[0][price_usd]" class="form-control rounded-0" placeholder="0.00" value="">
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light" style="width: 35px;">€</span>
                                            <input type="text" name="discount[0][price_eur]" class="form-control rounded-0" placeholder="0.00" value="">
                                        </div>
                                    </td>
                                    <td style="width: 12%;">
                                        <select name="discount[0][type]" class="form-select rounded-0" style="font-size: 13px;">
                                            <option value="price">İndirimli Fiyat</option>
                                            <option value="percentage">Yüzde (%)</option>
                                        </select>
                                    </td>
                                    <td style="width: 20%;">
                                        <input type="date" name="discount[0][start_date]" class="form-control form-control-sm rounded-0 mb-1">
                                        <input type="date" name="discount[0][end_date]" class="form-control form-control-sm rounded-0">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm rounded-0 remove-discount">Kaldır</button>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="text-end">
                            <button type="button" id="add_discount_btn"
                                    class="btn btn-outline-success btn-sm rounded-0 px-4">İndirim Ekle
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>

    $(document).on('change', 'select[name*="[type]"]', function () {
        let selectedType = $(this).val();
        let row = $(this).closest('tr');
        let placeholderText = (selectedType === 'percentage') ? '%' : '0.00';

        row.find('input[name*="[price_]"]').attr('placeholder', placeholderText);
    });
    let rowIdx = <?= isset($product_discounts) ? count($product_discounts) : 0 ?>;

    $('#add_discount_btn').click(function () {
        $('#no_discount_row').remove();

        let html = `
    <tr>
        <td style="width: 15%;">
            <select name="discount[${rowIdx}][customer_group]" class="form-select rounded-0" style="font-size: 13px;">
                <option value="Müşteri">Müşteri</option>
                <option value="VIP">VIP</option>
            </select>
        </td>
        <td style="width: 10%;">
            <input type="number" name="discount[${rowIdx}][priority]" class="form-control text-center rounded-0" value="1" style="font-size: 13px;">
        </td>
        <td style="width: 25%;">
            <div class="input-group input-group-sm mb-1">
                <span class="input-group-text bg-light" style="width: 35px;">TL</span>
                <input type="text" name="discount[${rowIdx}][price_tl]" class="form-control rounded-0" placeholder="0.00">
            </div>
            <div class="input-group input-group-sm mb-1">
                <span class="input-group-text bg-light" style="width: 35px;">$</span>
                <input type="text" name="discount[${rowIdx}][price_usd]" class="form-control rounded-0" placeholder="0.00">
            </div>
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-light" style="width: 35px;">€</span>
                <input type="text" name="discount[${rowIdx}][price_eur]" class="form-control rounded-0" placeholder="0.00">
            </div>
        </td>
        <td style="width: 12%;">
            <select name="discount[${rowIdx}][type]" class="form-select rounded-0" style="font-size: 13px;">
                <option value="price">İndirimli Fiyat</option>
                <option value="percentage">Yüzde (%)</option>
            </select>
        </td>
        <td style="width: 20%;">
            <input type="date" name="discount[${rowIdx}][start_date]" class="form-control form-control-sm rounded-0 mb-1" style="font-size: 12px;">
            <input type="date" name="discount[${rowIdx}][end_date]" class="form-control form-control-sm rounded-0" style="font-size: 12px;">
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm rounded-0 remove-discount">Kaldır</button>
        </td>
    </tr>`;

        $('#discount_table_body').append(html);
        rowIdx++;
    });

    $(document).on('click', '.remove-discount', function () {
        $(this).closest('tr').remove();

        if ($('#discount_table_body tr').length === 0) {
            $('#discount_table_body').append(`
            <tr id="no_discount_row">
                <td colspan="6" class="text-center text-muted py-4">
                    <i class="fa fa-info-circle me-2"></i> Bu ürün için henüz bir indirim tanımlanmadı.
                </td>
            </tr>
        `);
        }
    });
    /* global CKEDITOR, $ */
    $(document).ready(function () {
        if (CKEDITOR.instances['editor_tr']) {
            CKEDITOR.instances['editor_tr'].destroy(true);
        }
        CKEDITOR.replace('editor_tr', {
            height: 300,
        });
        $('#main_image_area').click(function () {
            $('#main_file').trigger('click');
        });
    });
    document.getElementById('additional_images_input').addEventListener('change', function () {
        const previewArea = document.getElementById('additional_preview_area');

        Array.from(this.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const html = `
                <div class="col-sm-3 mb-3 text-center position-relative shadow-sm border p-1" style="background: #e9ecef;">
                    <img src="${e.target.result}" class="img-thumbnail rounded-0 border-0" style="width: 100%; height: 120px; object-fit: cover;" alt="">
                    <span class="badge bg-success position-absolute top-0 start-0">Yeni</span>
                </div>`;
                previewArea.insertAdjacentHTML('beforeend', html);
            }
            reader.readAsDataURL(file);
        });
    });


    function deleteImage(imageId, element) {
        $.ajax({
            url: "<?= site_url('product/delete_image/') ?>" + imageId,
            type: "POST",
            dataType: "JSON",
            success: function (response) {
                if (response.status === true) {
                    alert("Resim silindi.");
                    location.reload();
                }
            }
        });
    }</script>
</body>
</html>