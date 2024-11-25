
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
            <h1>Quản Lý Danh Mục Sản Phẩm</h1>
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
                <a href="<?= BASE_URL_ADMIN . '?act=form-them-danh-muc' ?>"><button class="btn btn-success">Thêm danh mục</button></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên Danh Mục</th>
                    <th>Mô tả </th>
                    <th>Tha tác</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($listDanhMuc as $key=>$danhMuc): ?>
                <tr>
                   <td><?= $key+1 ?></td>
                   <td><?=$danhMuc['ten_danh_muc'] ?></td>
                   <td><?=$danhMuc['mo_ta'] ?></td>
                    <td>
                      <a href="<?= BASE_URL_ADMIN . '?act=form-sua-danh-muc&id_danh_muc=' .$danhMuc['id'] ?>"><button class="btn btn-warning">Sửa </button></a>
                      <a href="<?= BASE_URL_ADMIN . '?act=xoa-danh-muc&id_danh_muc=' . $danhMuc['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa chứ?')">Xóa</a>
                
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

