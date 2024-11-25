<!-- herder -->
<?php include './views/layout/header.php'; ?>
<!-- end herder -->
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sửa tài khoản Khách hàng  </h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row"> 
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Sửa tài khoản : <?= $khachHang['ho_ten'] ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="<?= BASE_URL_ADMIN . '?act=sua-khach-hang' ?>" method="POST">
                <input type="hidden" name="khach_hang_id" value="<?= $khachHang['id'] ?>">
              <div class=" card-body">
                <div class="form-group">
                  <label>Họ Tên :</label>
                  <input type="text" class="form-control" name="ho_ten" value="<?= $khachHang['ho_ten'] ?>" placeholder="Nhập tên vào đây">
                  <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                  <?php } ?>
                </div>
                <!-- /// -->
                <div class="form-group">
                  <label>Email :</label>
                  <input type="Email" class="form-control" name="email" value="<?= $khachHang['email'] ?>" placeholder="Nhập email vào đây">
                  <?php if (isset($_SESSION['error']['email'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                  <?php } ?>
                </div>
                <!-- /// -->
                <div class="form-group">
                  <label>Số điện thoại :</label>
                  <input type="text" class="form-control" name="so_dien_thoai" value="<?= $khachHang['so_dien_thoai'] ?>" placeholder="Nhập số điện thoại vào đây">
                  <?php if (isset($_SESSION['error']['so_dien_thoai'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                  <?php } ?>
                </div>
                <!-- /// -->
                <div class="form-group">
                  <label>Ngày sinh :</label>
                  <input type="date" class="form-control" name="ngay_sinh" value="<?= $khachHang['ngay_sinh'] ?>" placeholder="Nhập ngày sinh vào đây">
                  <?php if (isset($_SESSION['error']['ngay_sinh'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['ngay_sinh'] ?></p>
                  <?php } ?>
                </div>
                <!-- /// -->
                <div class="form-group">
                  <label>Giơi tính :</label>
                  <select id="gioi_tinh" name="gioi_tinh" class="form-control custom-select">
                        <option <?= $khachHang['gioi_tinh'] == 1 ? 'selected' : '' ?> value="1">NAM</option>
                        <option <?= $khachHang['gioi_tinh'] == 2 ? 'selected' : '' ?> value="2">Nữ</option>
                  </select>
                  
                </div>
                <!-- /// -->
                <div class="form-group">
                  <label>Địa chỉ :</label>
                  <input type="text" class="form-control" name="dia_chi" value="<?= $khachHang['dia_chi'] ?>" placeholder="Nhập địa chỉ vào đây">
                  <?php if (isset($_SESSION['error']['dia_chi'])) { ?>
                    <p class="text-danger"><?= $_SESSION['error']['dia_chi'] ?></p>
                  <?php } ?>
                </div>
                <!-- /// -->
                <div class="form-group">
                                <label for="inputStatus">Trạng Thái</label>
                                <select id="inputStatus" name="trang_thai" class="form-control custom-select">
                                    <option <?= $khachHang['trang_thai'] == 1  ? 'selected' : '' ?> value="1">Activ e</option>
                                    <option <?= $khachHang['trang_thai'] !==1  ? 'selected' : '' ?> value="2">Inactive</option>
                                </select>
                            </div>
                <!-- /// -->
                



              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>

            </form>
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- footer -->
<?php include './views/layout/footer.php';   ?>
<!-- end footer -->
<!-- Page specific script -->

<!-- Code injected by live-server -->

</body>

</html>