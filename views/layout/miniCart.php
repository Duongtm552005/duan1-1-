<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="pe-7s-close"></i>
            </div>

            <!-- Check if cart has items -->
            <?php if (!empty($chiTietGioHang)): ?>
                <table>
                    <tbody>
                        <?php
                        $tong_tien_gio_hang = 0;
                        foreach ($chiTietGioHang as $key => $sanPham):
                            $sanPhamPrice = $sanPham['gia_khuyen_mai'] ? $sanPham['gia_khuyen_mai'] : $sanPham['gia_san_pham'];
                            $subtotal = $sanPhamPrice * $sanPham['so_luong'];
                            $tong_tien_gio_hang += $subtotal;
                        ?>
                            <tr>
                                <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="Product" /></a></td>
                                <td class="pro-title"><a href="#"><?= $sanPham['ten_san_pham'] ?></a></td>
                                <td class="pro-price">
                                    <span><?= formatprice($sanPhamPrice) . ' đ' ?></span> 
                                </td>
                                <td class="pro-quantity">
                                    <input type="number" style="width: 50px; border: none;" value="<?= $sanPham['so_luong'] ?>" name="so_luong[<?= $sanPham['id'] ?>]" min="1" class="quantity-input" data-price="<?= $sanPhamPrice ?>" />
                                </td>
                                <td class="pro-subtotal">
                                    <span class="subtotal-amount"><?= formatprice($subtotal) . ' đ' ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Cart Summary -->
                <?php 
                    $shipping_cost = 20.00; // Ví dụ: phí vận chuyển cố định
                    $total_payment = $tong_tien_gio_hang + $shipping_cost;
                ?>
                <div class="minicart-pricing-box">
                    <ul>
                        <li>
                            <span>Tổng tiền sản phẩm</span>
                            <span><strong><?= formatprice($tong_tien_gio_hang) . ' đ' ?></strong></span>
                        </li>
                        <li>
                            <span>Phí vận chuyển</span>
                            <span><strong><?= formatprice($shipping_cost) . ' đ' ?></strong></span>
                        </li>
                        <li class="total">
                            <span>Tổng thanh toán</span>
                            <span><strong><?= formatprice($total_payment) . ' đ' ?></strong></span>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <p>Giỏ hàng của bạn đang trống</p>
            <?php endif; ?>
            <div class="minicart-button">
                    <a href="<?= BASE_URL . '?act=gio-hang' ?>"><i class="fa fa-shopping-cart"></i>Xem giỏ hàng</a>
                    <a href="<?= BASE_URL . '?act=thanh-toan'?>"><i class="fa fa-share"></i> Thanh toán</a>
                </div>
        </div>
    </div>
</div>
<!-- offcanvas mini cart end -->
