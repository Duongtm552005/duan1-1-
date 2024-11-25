
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
            <h1>Quản Lý Danh Sách đơn hàng </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Tên người nhận</th>
                    <th>Số điện thoại</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($listDonHang as $key => $donHang): ?>
                <tr>
                   <td><?= $key+1 ?></td>
                   <td><?=$donHang['ma_don_hang'] ?></td>
                   <td><?=$donHang['ten_nguoi_nhan'] ?></td>
                   <td><?=$donHang['sdt_nguoi_nhan'] ?></td>
                   <td><?=$donHang['dia_chi_nguoi_nhan'] ?></td>
                   <td><?=$donHang['ngay_dat'] ?></td>
                   <td><?=$donHang['tong_tien'] ?></td>
                   <td><?=$donHang['ten_trang_thai'] ?></td>
                   <span class="badge text-bg-primary <?=$donHang['ten_trang_thai'] ?>"></span>
                    <td>
                      <div class = "btn-group">
                      <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' .$donHang['id'] ?>">
                        <button class="btn btn-primary"><i class="fa-solid fa-eye"></i></button>
                      </a>
                      <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' .$donHang['id'] ?>">
                        <button class="btn btn-warning"><i class="fa-solid fa-screwdriver"></i></button>
                      </a>
                    </td>
                </tr>
            <?php endforeach; ?>
                </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
   <?php   include './views/layout/footer.php';   ?>
   <!-- end footer -->
<!-- Page specific script -->

<!-- Code injected by live-server -->

</body>
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
</html>

