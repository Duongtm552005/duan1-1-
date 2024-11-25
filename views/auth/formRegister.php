<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>

<main>
    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 40vw">
            <div class="member-area-from-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap">
                            <h5 class="text-center">ĐĂNG KÝ</h5>
                            <?php if (isset($_SESSION['error'])) { ?>
                                <p class="text-danger text-center"><?= $_SESSION['error'] ?></p>
                                <?php unset($_SESSION['error']); ?>
                            <?php } ?>
                            <form action="<?= BASE_URL . '?act=post-register' ?>" method="post">
                                <div class="single-input-item">
                                    <label for="ho_ten">Họ tên:</label>
                                    <input type="text" id="ho_ten" name="ho_ten" placeholder="Nhập họ tên" required>
                                </div>
                                <div class="single-input-item">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" placeholder="Nhập email" required>
                                </div>
                                <div class="single-input-item">
                                    <label for="password">Mật khẩu:</label>
                                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                                </div>
                                <div class="single-input-item">
                                    <label for="ngay_sinh">Ngày sinh:</label>
                                    <input type="date" id="ngay_sinh" name="ngay_sinh" required>
                                </div>
                                <div class="single-input-item">
                                    <label for="so_dien_thoai">Số điện thoại:</label>
                                    <input type="text" id="so_dien_thoai" name="so_dien_thoai" placeholder="Nhập số điện thoại" required>
                                </div>
                                <div class="single-input-item">
                                    <label for="gioi_tinh">Giới tính:</label>
                                    <select id="gioi_tinh" name="gioi_tinh" required>
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                    </select>
                                </div>
                                <div class="single-input-item">
                                    <label for="dia_chi">Địa chỉ:</label>
                                    <textarea id="dia_chi" name="dia_chi" placeholder="Nhập địa chỉ" required></textarea>
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn-sqr">Đăng ký</button>
                                </div>
                            </form>

                            <p class="text-center mt-3">
                                Đã có tài khoản? <a href="<?= BASE_URL . '?act=login' ?>">Đăng nhập</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'views/layout/footer.php'; ?>
