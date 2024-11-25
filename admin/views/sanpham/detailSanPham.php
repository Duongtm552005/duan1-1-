
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
          <h1>Quản lí Danh Sách Sản Phẩm</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="col-12">
                <img  style = "width:400px; height: 400px " src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <?php foreach($listAnhSanPham as $key => $anhSP):?>
                  <div class="product-image-thumb <?= $key == 0 ? 'active' : '' ?>"><img src="<?= BASE_URL . $anhSP['link_hinh_anh'] ?>" alt="Product Image"></div>
                <?php endforeach ?>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3">Tên Sản Phẩm: <?= $sanPham['ten_san_pham'] ?></h3>
              <hr>
              <h4 class="mt-3">Giá tiền: <small><?= $sanPham['gia_san_pham'] ?> VND</small></h4>
            <h4 class="mt-3">Giá khuyến mãi: <small><?= $sanPham['gia_khuyen_mai'] ?> VND</small></h4>
            <h4 class="mt-3">Số lượng: <small><?= $sanPham['so_luong'] ?></small></h4>
            <h4 class="mt-3">Lượt xem: <small><?= $sanPham['luot_xem'] ?></small></h4>
            <h4 class="mt-3">Ngày Nhập: <small><?= $sanPham['ngay_nhap'] ?></small></h4>
            <h4 class="mt-3">Danh Mục: <small><?= $sanPham['ten_danh_muc'] ?></small></h4>
            <h4 class="mt-3">Trạng thái: <small><?= $sanPham['trang_thai'] == 1 ? 'Còn Bán' : 'Dừng bán' ?> </small></h4>
            <h4 class="mt-3">Mô tả: <small><?= $sanPham['mo_ta'] ?></small></h4>

              
            </div>
          </div>
          <div class="col-12">
          <h2> Bình luận của khách hàng </h2>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>STT</th>
                <th>Người bình luận</th>
                <th>Nội dung</th>
                <th>Ngày bình luận </th>
                <th>Trạng thái </th>
                <th>Thao tác </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($listBinhLuan as $key => $binhLuan): ?>
                <tr>
                  <td><?= $key + 1 ?></td>
                  <td><a target="_blank"
                  href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['tai_khoan_id'] ?>">
                  <?= $binhLuan['ho_ten'] ?></a>
                  </td>
                  <td><a href=""></a><?= $binhLuan['noi_dung'] ?></td>
                  <td><?= $binhLuan['ngay_dang'] ?></td>
                  <td><?= $binhLuan['trang_thai'] == 1 ? 'Hiển thi' : 'Bị ẩn' ?></td>
                  <td>

                    <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan' ?>" method="POST">
                      <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">
                      <input type="hidden" name="name_view" value="detail_sanpham">
                      <button onclick="return confirm('Bạn có muốn ẩn bình luận này không ?')" class="btn btn-warning">
                        <?= $binhLuan['trang_thai'] == 1 ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>' ?>
                      </button>

                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot>
          </tfoot>
          </table>
        </div>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>
</html>

