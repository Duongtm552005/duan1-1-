<?php require_once 'layout/header.php';?>
<?php require_once 'layout/menu.php';?>

    <main>
        <!-- hero slider area start -->
        <section class="slider-area">
            <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/adidas-banner-1.jpg">
                        <div class="container">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/adidas-banner-2.jpg">
                        <div class="container">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/adidas-banner-3.jpg">
                        <div class="container">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- hero slider area end -->

        <!-- service policy area start -->
        <div class="service-policy section-padding">
            <div class="container">
                <div class="row mtn-30">
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-plane"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Giao Hàng</h6>
                                <p>Miễn Phí Giao Hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-help2"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Hỗ Trợ</h6>
                                <p>Hỗ Trợ 24/7</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-back"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Hoàn Tiền</h6>
                                <p>Hoàn Tiền Trong 30 Ngày</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-credit"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Thanh Toán</h6>
                                <p>Bảo Mật Thanh Toán</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service policy area end -->

        <!-- banner statistics area start -->
        <div class="banner-statistics-area">
            <div class="container">
                <div class="row row-20 mtn-20">
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="assets/img/slider/adidas-banner-1.jpg" alt="product banner" height="255">
                            </a>
                            <div class="banner-content text-right">
                                <h5 class="banner-text1"></h5>
                                <h2 class="banner-text2"><span></span></h2>
                                <a href="shop.html" class="btn btn-text"></a>
                            </div>
                        </figure>
                    </div>
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="assets/img/slider/adidas-banner-2.jpg" alt="product banner">
                            </a>
                            <div class="banner-content text-right">
                                <h5 class="banner-text1"></h5>
                                <h2 class="banner-text2"><span></span></h2>
                                <a href="shop.html" class="btn btn-text"></a>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner statistics area end -->

        <!-- product area start -->
        <section class="product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">Sản Phẩm Của Chúng Tôi</h2>
                            <p class="sub-title">Sản Phẩm Mới Nhất</p>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-container">

                            <!-- product tab content start -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1">
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
                            </div>
                            <!-- product tab content end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product area end -->
        <!-- featured product area start -->
        <section class="feature-product section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title text-center">
                    <h2 class="title">Sản phẩm nổi bật </h2>
                    <p class="sub-title">Sản phẩm nổi bật hàng tuần</p>
                </div>
                <!-- section title end -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                    <!-- product item start -->
                    <?php foreach ($listSanPham as $key => $sanPham): ?>
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

                                    if ($tinhNgay->days <= 7): ?>
                                        <div class="product-label new">
                                            <span>Mới</span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($sanPham['gia_khuyen_mai']): ?>
                                        <div class="product-label discount">
                                            <span>Giảm Giá</span>
                                        </div>
                                    <?php endif; ?>
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
                                    <?php if ($sanPham['gia_khuyen_mai']): ?>
                                        <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                        <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                    <?php else: ?>
                                        <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- product item end -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- featured product area end -->


        <!-- group product start -->
        <section class="group-product-area section-padding">
    <div class="container">
        <div class="row">
            <!-- Cột 1: Banner -->
            <div class="col-lg-4">
            <div class="section-title text-center">
                    <h2 class="title">Sản phẩm bán chạy </h2>
                    <p class="sub-title">Sản phẩm bán chạy </p>
                </div>
                <div class="group-product-banner">
                    
                    <figure class="banner-statistics">
                        <a href="#">
                            <img src="assets/img/slider/adidas-banner-2.jpg" alt="product banner">
                        </a>
                    </figure>
                </div>
            </div>

            <!-- Cột 2 và 3: Sản phẩm -->
            <div class="col-lg-8">
                <div class="row">
                    <?php
                    $totalProducts = count($listSanPham);
                    $halfProducts = ceil($totalProducts / 2);
                    $sanPhamCot1 = array_slice($listSanPham, 0, $halfProducts);
                    $sanPhamCot2 = array_slice($listSanPham, $halfProducts);
                    ?>

                    <!-- Cột sản phẩm 1 -->
                    <div class="col-lg-6">
                        <?php foreach ($sanPhamCot1 as $sanPham): ?>
                            <div class="group-item">
                                <figure class="group-item-thumb">
                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                        <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>">
                                    </a>
                                </figure>
                                <div class="group-item-desc text-center">
                                    <h6 class="group-product-name">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                    </h6>
                                    <div class="price-box">
                                        <?php if ($sanPham['gia_khuyen_mai']): ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                            <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                        <?php else: ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Cột sản phẩm 2 -->
                    <div class="col-lg-6">
                        <?php foreach ($sanPhamCot2 as $sanPham): ?>
                            <div class="group-item">
                                <figure class="group-item-thumb">
                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                        <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>">
                                    </a>
                                </figure>
                                <div class="group-item-desc text-center">
                                    <h6 class="group-product-name">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                    </h6>
                                    <div class="price-box">
                                        <?php if ($sanPham['gia_khuyen_mai']): ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ'; ?></span>
                                            <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></del></span>
                                        <?php else: ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) . 'đ'; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>