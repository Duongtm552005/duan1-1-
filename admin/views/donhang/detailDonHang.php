<!-- header -->
<?php include './views/layout/header.php'; ?>
<!-- end header -->

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
        <div class="col-sm-10">
          <h1>Quản Lý Danh Sách Đơn Hàng - Đơn Hàng: <?= $donHang['ma_don_hang'] ?> </h1>
        </div>
        <div class="col-sm-2">
          <form action="" method="post">
            <select name="" id="" class="form-group">
              <?php foreach ($listTrangThaiDonHang as $key => $trangThai): ?>
                <option 
                  <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?>
                  <?= $trangThai['id'] < $donHang['trang_thai_id'] ? 'disabled' : '' ?>
                  value="<?= $trangThai['id']; ?>"><?= $trangThai['ten_trang_thai']; ?>
                </option>
              <?php endforeach ?>
            </select>
          </form>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <?php
          if ($donHang['trang_thai_id'] == 1) {
              $colorAlberts = "primary";
          } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
              $colorAlberts = "warning";
          } elseif ($donHang['trang_thai_id'] == 10) {
              $colorAlberts = "success";
          } else {
              $colorAlberts = "danger";
          }
          ?>
          <div class="alert alert-<?= $colorAlberts; ?>" role="alert">
            Đơn hàng: <?= $donHang['ten_trang_thai'] ?>
          </div>

          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fa-solid fa-cart-shopping"></i> Shop Giày Adidas
                  <small class="float-right">Ngày Đặt Hàng: <?= formatDate($donHang['ngay_dat']); ?></small>
                </h4>
              </div>
              <!-- /.col -->
            </div>

            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Thông tin người đặt:
                <address>
                  <strong><?= $donHang['ho_ten'] ?></strong><br>
                  Email: <?= $donHang['email'] ?><br>
                  Số điện thoại: <?= $donHang['so_dien_thoai'] ?><br>
                </address>
              </div>
              <div class="col-sm-4 invoice-col">
                Người nhận
                <address>
                  <strong><?= $donHang['ten_nguoi_nhan'] ?></strong><br>
                  Email: <?= $donHang['email_nguoi_nhan'] ?><br>
                  Số điện thoại: <?= $donHang['sdt_nguoi_nhan'] ?><br>
                  Địa chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                </address>
              </div>
              <div class="col-sm-4 invoice-col">
                Thông tin
                <address>
                  <strong>Mã đơn hàng: <?= $donHang['ma_don_hang'] ?></strong><br>
                  Tổng tiền: <?= number_format($donHang['tong_tien'], 2) ?><br>
                  Ghi chú: <?= $donHang['ghi_chu'] ?><br>
                  Thanh toán: <?= $donHang['ten_phuong_thuc'] ?><br>
                </address>
              </div>
            </div>

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tên sản phẩm</th>
                      <th>Đơn giá</th>
                      <th>Số lượng</th>
                      <th>Thành tiền</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $tong_tien = 0;
                    foreach ($sanPhamDonHang as $key => $sanPham):
                    ?>
                      <tr>
                        <th><?= $key + 1 ?></th>
                        <th><?= $sanPham['ten_san_pham'] ?></th>
                        <th><?= number_format($sanPham['don_gia'], 2) ?></th>
                        <th><?= $sanPham['so_luong'] ?></th>
                        <th><?= number_format($sanPham['thanh_tien'], 2) ?></th>
                      </tr>
                      <?php $tong_tien += $sanPham['thanh_tien']; ?>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Totals -->
            <div class="row">
              <div class="col-6">
                <p class="lead">Ngày đặt hàng: <?= formatDate($donHang['ngay_dat']) ?></p>
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                    <th style="width:50%">Thành tiền:</th>
                    <td><?= number_format($tong_tien, 2) ?></td>
                  </tr>
                  <tr>
                    <th>Vận chuyển:</th>
                    <td>30,000</td>
                  </tr>
                  <tr>
                    <th>Tổng tiền</th>
                    <td><?= number_format($tong_tien + 30000, 2) ?></td>
                  </tr>
                  </table>
                </div>
              </div>
            </div>

          </div><!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- end footer -->

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "searching": false,
    });
  });
</script>

</body>
</html>
