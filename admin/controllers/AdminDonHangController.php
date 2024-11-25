<?php
class AdminDonHangController
{
    public $modelDonHang;
    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }

    public function danhSachDonHang()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang();

        require_once './views/donhang/listDonHang.php';
    }
    public function detailDonHang()
    {
        $don_hang_id = $_GET['id_don_hang'];
        
        //Lấy thông tin đơn hàng ở bảng don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);

        //Lấy danh sách sản phẩm đã đặt của đơn hàng ở bảng chi_tiet_don_hangs

        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);
        
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        // var_dump($sanPhamDonHang);die;
        require_once './views/donhang/detailDonHang.php';

    }
        /////

        public function formEditDonHang(){
            
            $id = $_GET['id_don_hang'];
            $donHang = $this->modelDonHang->getDetailDonHang($id);
            $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
            if ($donHang) {
                require_once './views/donhang/editDonHang.php';
                deleteSessionError();
            }else{
                header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
                exit();
            }
        }




        public function postEditDonHang()
    {
        ///// hàm này dùng để thêm dữ liệu sử lý.
        /// kiểm tra xem dữ liệu có phải đc submis lên không.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            // lấy ra dữ liệu cũ của sản phẩm
            $don_hang_id = $_POST['don_hang_id'] ?? '';
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan']  ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan']  ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan']  ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan']  ?? '';
            $ghi_chu = $_POST['ghi_chu']  ?? '';
            $trang_thai_id = $_POST['trang_thai_id']  ?? '';
           


            ///tạo một bẳng trống để chứa dữ liệu.
            $errors = [];
            if (empty($ten_nguoi_nhan)) {
                $errors['$ten_nguoi_nhan'] = 'Tên người nhận không được để trống.';
            }
            ///
            if (empty($sdt_nguoi_nhan)) {
                $errors['$sdt_nguoi_nhan'] = 'SDT người nhận không được để trống.';        }
            ///
            if (empty($email_nguoi_nhan)) {
                $errors['email_nguoi_nhan'] = 'Email người nhận không được để trống.';
            }
            ///
            if (empty($dia_chi_nguoi_nhan)) {
                $errors['dia_chi_nguoi_nhan'] = 'Địa chỉ không được để trống.';
            }
            ///
            if (empty($trang_thai_id)) {
                $errors['trang_thai_id'] = 'Trạng thái đơn hàng.';
            }
            
            $_SESSION['error'] = $errors;
            // var_dump($errors);die;
         
            // var_dump($don_hang_id);die;
            /// nếu không có lỗi thì => tiến hành thêm
            if (empty($errors)) {
                
                //  nếu khong có lỗi thì tiên hành sửa
                // var_dump( "oki la");
                $this->modelDonHang->updateDonHang( $don_hang_id,
                                                    $ten_nguoi_nhan,  
                                                    $sdt_nguoi_nhan, 
                                                    $email_nguoi_nhan, 
                                                    $dia_chi_nguoi_nhan, 
                                                    $ghi_chu,
                                                    $trang_thai_id 
                                                    );
                // sử lý thêm album ảnh
                header("Location: " . BASE_URL_ADMIN . '?act=don-hang');
                exit();
            } else {
                /// nêú có lỗi thì chả về form và lỗi.
                // require_once './views/sanpham/addSanPham.php';
                // Đặt một chỉ thị xóa session sau khi hiện thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . '?act=form-sua-don_hang&id_don_hang=' . $don_hang_id);
                exit();
            }
        }
    }
}