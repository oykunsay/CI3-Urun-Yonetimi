<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün ve İndirim Listesi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-size: 13px;
        }

        .nav-tabs .nav-link {
            color: #495057;
            border-radius: 0;
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            background-color: #fff;
            border-bottom-color: transparent;
            color: #0d6efd;
        }

        .table img {
            object-fit: cover;
            border: 1px solid #dee2e6;
        }

        .card {
            border-radius: 0;
        }
    </style>
</head>
<body>

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Ürün Yönetimi</h5>
        <a href="<?= site_url('product/form') ?>" class="btn btn-success btn-sm rounded-0">
            <i class="fa fa-plus"></i> Yeni Ürün Ekle
        </a>
    </div>

    <div class="card">
        <div class="card-header bg-white p-0">
            <ul class="nav nav-tabs border-bottom-0" id="listTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active px-4" id="products-tab" data-bs-toggle="tab"
                            data-bs-target="#tab-products" type="button" role="tab">
                        Ürünler
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link px-4" id="discounts-tab" data-bs-toggle="tab"
                            data-bs-target="#tab-discounts" type="button" role="tab">
                        İndirimler
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body p-0">
            <div class="tab-content" id="listTabContent">

                <div class="tab-pane fade show active" id="tab-products" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0 align-middle">
                            <thead class="table-light text-nowrap">
                            <tr>
                                <th>ID</th>
                                <th>Resim</th>
                                <th>Ürün Kodu</th>
                                <th>Başlık</th>
                                <th>Stok</th>
                                <th>Fiyat (TL)</th>
                                <th>Durum</th>
                                <th class="text-center">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $p): ?>
                                    <tr>
                                        <td><?= $p->id ?></td>
                                        <td>
                                            <?php if (!empty($p->main_image)): ?>
                                                <img src="<?= base_url('uploads/products/' . $p->main_image) ?>"
                                                     style="width: 50px; height: 50px;" alt="">
                                            <?php else: ?>
                                                <small class="text-muted">Resim Yok</small>
                                            <?php endif; ?>
                                        </td>
                                        <td><strong><?= $p->product_code ?></strong></td>
                                        <td><?= $p->title ?></td>
                                        <td>
                                            <?php if ($p->stock_amount <= 0): ?>
                                                <span class="badge bg-danger">Stokta Yok</span>
                                            <?php else: ?>
                                                <span class="badge bg-success"><?= $p->stock_amount ?> Adet</span>
                                            <?php endif; ?>
                                        </td>                                        <td><?= $p->price_tl ? number_format($p->price_tl, 2) . ' TL' : '-' ?></td>
                                        <td>
                                                <span class="badge <?= $p->status ? 'bg-success' : 'bg-secondary' ?>">
                                                    <?= $p->status ? 'Aktif' : 'Pasif' ?>
                                                </span>
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <a href="<?= site_url('product/form/' . $p->id) ?>"
                                               class="btn btn-primary btn-sm rounded-0">
                                                <i class="fa fa-edit"></i> Düzenle
                                            </a>
                                            <a href="<?= site_url('product/delete/' . $p->id) ?>"
                                               class="btn btn-danger btn-sm rounded-0"
                                               onclick="return confirm('Bu ürünü silmek istediğine emin misin?')">
                                                <i class="fa fa-trash"></i> Sil
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4">Ürün bulunamadı.</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade p-4" id="tab-discounts" role="tabpanel">
                    <div class="alert alert-info rounded-0">
                        <i class="fa fa-info-circle"></i> Sadece indirim tanımlanmış ürünler burada listelenir.
                    </div>
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                        <tr>
                            <th>Ürün ID</th>
                            <th>Ürün</th>
                            <th>Müşteri Grubu</th>
                            <th>Öncelik</th>
                            <th>İndirimli Fiyat / Yüzde(%)</th>
                            <th>Başlangıç</th>
                            <th>Bitiş</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($discounted_products)): ?>
                            <?php foreach ($discounted_products as $row): ?>
                                <tr>
                                    <td><?= $row->product_id ?></td>
                                    <td><?= $row->product_name ?></td>
                                    <td><?= $row->customer_group ?></td>
                                    <td class="text-center"><?= $row->priority ?></td>
                                    <td><?= number_format($row->discount_value, 2) ?> <?= $row->currency ?></td>
                                    <td><?= $row->start_date ?></td>
                                    <td><?= $row->end_date ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('product/form/' . $row->product_id) ?>"
                                           class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">Henüz indirimli ürün datası
                                    bulunamadı.
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>