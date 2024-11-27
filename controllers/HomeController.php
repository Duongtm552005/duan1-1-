<?php 

class HomeController
{
    public $modelSanPham;
    public $modelDanhMuc;

    public $modelTaiKhoan;
    // public $modelGioHang;
    // public $modelDangKy;
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelDanhMuc = new DanhMuc();
        // $this->modelGioHang = new GioHang();
    }

    public function sanPham()
{
    // Lấy danh sách danh mục
    $danhMuc = $this->modelDanhMuc->getAllDanhMuc();

    // Lấy danh sách sản phẩm từ model SanPham
    $listSanPham = $this->modelSanPham->getAllSanPham();

    // Truyền vào view
    require_once './views/sanPham.php';
}


    public function home(){
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }
    
    public function chiTietSanPham(){
        $id = $_GET['id_san_pham'];  

        $sanPham = $this->modelSanPham->getDetailSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);
        // var_dump($listAnhSanPham); die();
        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header("Location:" . BASE_URL);
            exit();
        }
    }
    
    public function formLogin(){
        require_once './views/auth/formLogin.php';

        deleteSessionError();
        exit();
    }
    
    public function postLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? ''; 
            $password = $_POST['password'] ?? ''; 
            $user = $this->modelTaiKhoan->checkLogin($email, $password);
            if ($user) {     
                $_SESSION['user_client'] = $user; 
    
                header("Location: " . BASE_URL_ADMIN);
                exit();
            } else {
                // Nếu đăng nhập thất bại, thông báo lỗi
                $_SESSION['error'] = 'Đăng nhập thất bại!';
                header("Location: ". BASE_URL ."?act=login");
                exit();
            }
        }
    }
    

    // Hiển thị form đăng ký
    public function formRegister(){
        require_once './views/auth/formRegister.php';
        deleteSessionError(); // Xóa lỗi nếu có
        exit();
    }

    // Xử lý dữ liệu đăng ký
    public function postRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $ho_ten = $_POST['ho_ten'] ?? ''; 
            $email = $_POST['email'] ?? ''; 
            $password = $_POST['password'] ?? ''; 
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? 1; // Mặc định Nam
            $dia_chi = $_POST['dia_chi'] ?? '';
            $chuc_vu_id = 2; 
            $trang_thai = 1; 
            
            // Mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
            // Đăng ký người dùng
            $success = $this->modelTaiKhoan->register(
                $ho_ten, 
                $email, 
                $hashedPassword, 
                $ngay_sinh, 
                $so_dien_thoai, 
                $gioi_tinh, 
                $dia_chi, 
                $chuc_vu_id, 
                $trang_thai
            );
    
            if ($success) {
                $_SESSION['success'] = 'Đăng ký thành công!';
                header("Location: " . BASE_URL . '?act=login');
                exit();
            } else {
                $_SESSION['error'] = 'Đăng ký thất bại. Vui lòng thử lại!';
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }
        }
    }
    public function logout() {
        // Xóa thông tin người dùng khỏi session
        unset($_SESSION['user_client']);
        session_destroy();
    
        // Điều hướng về trang đăng nhập hoặc trang chủ
        header("Location: " . BASE_URL . "?act=login"); // Hoặc BASE_URL nếu bạn muốn về trang chủ
        exit();
    }


    public function thanhToan(){
        require_once './views/thanhToan.php';
    }
    
}

    
    


    
    
    
    
    
