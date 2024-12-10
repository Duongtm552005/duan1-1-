
<?php require_once 'layout/header.php';?>
<?php require_once 'layout/menu.php';?>
<main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= BASE_URL  ?>"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">shop</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- page main wrapper start -->
        <div class="shop-main-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <!-- sidebar area start -->
                    <div class="col-lg-3 order-2 order-lg-1">
                        <aside class="sidebar-wrapper">
                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                            <h5 class="sidebar-title">Danh Mục</h5>
                            <div class="sidebar-body">
                            <ul class="shop-categories">
                            <?php if (!empty($danhMuc)): ?>
                                <?php foreach ($danhMuc as $dm): ?>
                                    <li>
                                        <a href="<?= BASE_URL . '?act=san-pham&danh_muc_id=' . $dm['id'] ?>">
                                            <?= htmlspecialchars($dm['ten_danh_muc']) ?>
                                            <span>(<?= htmlspecialchars($dm['mo_ta'] ?: '0') ?>)</span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>Không có danh mục nào</li>
                            <?php endif; ?>
                        </ul>

                            </div>
                        </div>
                </aside>
                    </div>
                    <!-- sidebar area end -->

                    <!-- shop main wrapper start -->
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="shop-product-wrapper">
                            <!-- shop product top wrap start -->
                            <div class="shop-top-bar">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                        <div class="top-bar-left">
                                            <div class="product-view-mode">
                                                <a class="active" href="#" data-target="grid-view" data-bs-toggle="tooltip" title="Grid View"><i class="fa fa-th"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                        
                                </div>
                            </div>
                            <!-- shop product top wrap start -->

                            <!-- product item list wrapper start -->
                                <!-- product single item start -->
                                <div class="shop-product-wrap grid-view row mbn-30">
                                <!-- product single item start -->
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                        <!-- product item start -->
                                        <?php foreach($listSanPham as $key=>$sanPham): ?>
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                    <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                                    if ($tinhNgay->days <=7){ ?>
                                                    <div class="product-label new">
                                                        <span>Mới</span>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if ($sanPham['gia_khuyen_mai']){?>
                                                    <div class="product-label discount">
                                                        <span>Giảm Giá</span>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">Xem Chi Tiết</button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <h6 class="product-name">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                                </h6>
                                                <div class="price-box">
                                                    <?php if($sanPham['gia_khuyen_mai']){ ?>
                                                        <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']).'đ'; ?></span>
                                                        <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']).'đ'; ?></del></span>
                                                    <?php }else{ ?>
                                                        <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']).'đ'; ?></del></span>
                                                    <?php } ?>   
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product item end -->
                                         <?php endforeach ?>
                                    </div>
                            </div>
                            <div class="paginatoin-area text-center">
                                <ul class="pagination-box">
                                    <li><a class="previous" href="#"><i class="pe-7s-angle-left"></i></a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a class="next" href="#"><i class="pe-7s-angle-right"></i></a></li>
                                </ul>
                            </div>
                            <!-- end pagination area -->
                        </div>
                    </div>
                    <!-- shop main wrapper end -->
                </div>
            </div>
        </div>
        <!-- page main wrapper end -->
    </main>

    <?php require_once 'layout/miniCart.php'; ?>

<?php require_once 'layout/footer.php' ?>