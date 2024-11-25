<?php
class AdminSanPhamController
{
    public $modelSanPham;
    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function danhSachSanPham()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/sanpham/listSanPham.php';
    }
    public function formAddSanPham()
    {
        // hàm này dùng để hiện thị form nhập
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanpham/addSanPham.php';
        // xóa sesstion sau khi load trang
        deleteSessionError();
    }
    public function postAddSanPham()
    {
        // hàm này dùng để thêm dữ liệu sử lý.
        // kiểm tra xem dữ liệu có phải đc submis lên không.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            $ten_san_pham = $_POST['ten_san_pham']  ?? '';
            $gia_san_pham = $_POST['gia_san_pham']  ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai']  ?? '';
            $so_luong = $_POST['so_luong']  ?? '';
            $ngay_nhap = $_POST['ngay_nhap']  ?? '';
            $danh_muc_id = $_POST['danh_muc_id']  ?? '';
            $trang_thai = $_POST['trang_thai']  ?? '';
            $mo_ta = $_POST['mo_ta']  ?? '';

            $hinh_anh = $_FILES['hinh_anh']  ?? null;
            // lưu hình ảnh vào
            $file_thumb = uploadFile($hinh_anh, './uploads/');


            $img_array = $_FILES['img_array'];

            // kiểm tra dữ liệu

            //tạo một bẳng trống để chứa dữ liệu.
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống.';
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống.';
            }
            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'Giá khuyến mãi không được.';
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng không được để trống.';
            }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập không được để trống.';
            }
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục không được để trống.';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái không được để trống.';
            }
            if ($hinh_anh['error'] !== 0) {
                $errors['hinh_anh'] = 'Trạng thái không được để trống.';
            }

            $_SESSION['error'] = $errors;
         
            // nếu không có lỗi thì => tiến hành thêm
            if (empty($errors)) {
                //  nếu khong có lỗi thì tiên hành thêm sản phẩm
                // var_dump( "oki la");
                $san_pham_id = $this->modelSanPham->insertSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $file_thumb);
                // sử lý thêm album ảnh

                if (!empty($img_array['name'])) {
                    foreach ($img_array['name'] as $key => $value) {
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key],
                            'name' => $img_array['name'][$key],
                
                        ];
                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh);
                    }
                }
                header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // nêú có lỗi thì chả về form và lỗi.
                // Đặt một chỉ thị xóa session sau khi hiện thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-them-san-pham');
                exit();
            }
        }
    }
        public function formEditSanPham(){
            // hàm này dùng để hiện thị form nhập
            // lấy ra thông tin của sản phẩm cần sửa 
            $id = $_GET['id_san_pham'];
            $sanPham = $this->modelSanPham->getDetailSanPham($id);
            $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
            $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
            if ($sanPham) {
                require_once './views/sanpham/editSanPham.php';
                deleteSessionError();
            }else{
                header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            }
        }




        public function postEditSanPham()
    {
        //hàm này dùng để thêm dữ liệu xử lý.
        // kiểm tra xem dữ liệu có phải đc submit lên không.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            // lấy ra dữ liệu cũ của sản phẩm
            $san_pham_id = $_POST['san_pham_id'] ?? '';
            // truy vấn
            $sanPhanOld = $this->modelSanPham->getDetailSanPham($san_pham_id);
            $old_file = $sanPhanOld['hinh_anh']; //lấy ảnh cũ để phục vụ cho  sửa ảnh 

            $ten_san_pham = $_POST['ten_san_pham']  ?? '';
            $gia_san_pham = $_POST['gia_san_pham']  ?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai']  ?? '';
            $so_luong = $_POST['so_luong']  ?? '';
            $ngay_nhap = $_POST['ngay_nhap']  ?? '';
            $danh_muc_id = $_POST['danh_muc_id']  ?? '';
            $trang_thai = $_POST['trang_thai']  ?? '';
            $mo_ta = $_POST['mo_ta']  ?? '';

            $hinh_anh = $_FILES['hinh_anh']  ?? null;

            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống.';
            }
            
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống.';
            }
            
            if (empty($gia_khuyen_mai)) {
                $errors['gia_khuyen_mai'] = 'Giá khuyến mãi không được.';
            }
            
            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng không được để trống.';
            }
            
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập không được để trống.';
            }
            
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục không được để trống.';
            }
            
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái không được để trống.';
            }
            
            $_SESSION['error'] = $errors;
            // var_dump($errors);die;
            // logic sửa ảnh
            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                // upload file anh moi len 
                $new_file = uploadFile($hinh_anh, './uploads/');
                if (!empty($old_file)) {  // nếu có ảnh cũ thì xóa đi
                    deleteFile($old_file);
                }
            }else{
                    $new_file = $old_file;
                }
         
             //nếu không có lỗi thì => tiến hành thêm
            if (empty($errors)) {
                
                //  nếu khong có lỗi thì tiên hành thêm sản phẩm
                // var_dump( "oki la");
                $this->modelSanPham->updateSanPham($san_pham_id,  $ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $new_file);
                // sử lý thêm album ảnh
                header("Location: " . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                // nêú có lỗi thì chả về form và lỗi.
                // require_once './views/sanpham/addSanPham.php';
                // Đặt một chỉ thị xóa session sau khi hiện thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }
        }
    }
    // sửa album ảnh
    // - sửa ảnh cũ
    // +thêm ảnh mới
    // +không thêm ảnh mới
    // -không sửa ảnh cũ
    // +thêm ảnh mới
    // + không thêm ảnh mới
    // - xóa ảnh cũ
    // +thêm ảnh mới
    // + không thêm ảnh mới
    public function postEditAnhSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $san_pham_id = $_POST['san_pham_id'] ?? '';

            $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);
            $img_array  = $_FILES['img_array'];
            $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
            $current_img_ids = $_POST['current_img_ids'] ?? [];

            $upload_files = [];

            foreach ($img_array['name'] as $key => $value) {
                if ($img_array['error'][$key] == UPLOAD_ERR_OK) {
                    $new_file = uploadfileAlbum($img_array, './upload/', $key);
                    if ($new_file) {
                        $upload_files[] = [
                            'id' => $current_img_ids[$key] ?? null,
                            'file' => $new_file
                        ];
                    }
                }
            }

    
            // Lưu ảnh mới vào db và xóa ảnh cũ nếu có
            foreach ($upload_files as $file_info) {
                if ($file_info['id']) {
                    $old_file = $this->modelSanPham->getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];
                    $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);
                    deleteFile($old_file);
                } else {
                    $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
                }
            }
    
            // Xử lý xóa ảnh
            foreach ($listAnhSanPhamCurrent as $anhSP) {
                $anh_id = $anhSP['id'];
                if (in_array($anh_id, $img_delete)) {
                    $this->modelSanPham->destroyAnhSanPham($anh_id);
                    deleteFile($anhSP['link_hinh_anh']);
                }
            }

            header("Location:" . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }


    
    public function deleteSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        if ($sanPham) {
            deleteFile($sanPham['hinh_anh']);
            $this->modelSanPham->destroySanPham($id);
            if ($listAnhSanPham) {
                foreach ($listAnhSanPham as $key => $anhSP) {
                    deleteFile($anhSP['link_hinh_anh']);
                    $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
                }
            }
        }
        header("Location:" . BASE_URL_ADMIN . '?act=san-pham');
        exit();
    }
    public function detailSanPham()
    {
        $id = $_GET['id_san_pham'];  // Đảm bảo đây là 'id_san_pham'
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        // var_dump($listAnhSanPham); die();
        if ($sanPham) {
            require_once './views/sanpham/detailSanPham.php';
        } else {
            header("Location:" . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }
        public function updateTrangThaiBinhLuan(){
            $id_binh_luan = $_POST['id_binh_luan'];
            $name_view = $_POST['name_view'];
            $id_khach_hang = $_POST['id_khach_hang'];
            $binhLuan = $this->modelSanPham->getDetailBinhLuan($id_binh_luan);
            if($binhLuan){
                $trang_thai_update = '';
                if($binhLuan['trang_thai'] == 1){
                    $trang_thai_update = 2;
                }else{
                    $trang_thai_update = 1;
                }
               $status = $this->modelSanPham->updateTrangThaiBinhLuan($id_binh_luan, $trang_thai_update);
               if ($status){
                if ($name_view == 'detail_khach'){
                    header("Location: " . BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $binhLuan['tai_khoan_id']);
                }else{
                    header("Location: " . BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id']);

                }
               }
                
            }
        }

}