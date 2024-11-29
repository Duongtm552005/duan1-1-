<?php 

class HomeController
{
    public $modelSanPham;
    public $modelDanhMuc;

    public $modelTaiKhoan;
    public $modelGioHang;
    // public $modelDangKy;
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelDanhMuc = new DanhMuc();
        $this->modelGioHang = new GioHang();
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
    
    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? ''; 
            $password = $_POST['password'] ?? ''; 
    
            $result = $this->modelTaiKhoan->checkLogin($email, $password);
    
            if (is_array($result)) { // Đăng nhập thành công
                $_SESSION['user_client'] = $result;
    
                if ($result['chuc_vu_id'] == 1) { // Admin
                    header("Location: " . BASE_URL_ADMIN); // Chuyển hướng tới trang admin
                } elseif ($result['chuc_vu_id'] == 2) { // Khách hàng
                    header("Location: " . BASE_URL); // Chuyển hướng tới trang chủ
                }
                exit();
            } else { // Thông báo lỗi (chuỗi thông báo từ `checkLogin`)
                $_SESSION['error'] = $result;
                header("Location: " . BASE_URL . "?act=login");
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


   
    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                    $gioHang = ['id' => $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                } else {
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }

                $san_pham_id = $_POST['san_pham_id'];

                $so_luong = $_POST['so_luong'];

                $checkSanPham = false;

                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $newSoLuong = $detail['so_luong'] + $so_luong;
                        $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                        $checkSanPham = true;
                        break;
                    }
                }
                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
                }
                header("Location:" . BASE_URL . '?act=gio-hang');
            } else {
                var_dump('Chua Dang Nhap');
                die;
            }
        }
    }

    public function gioHang()
    {
        if (isset($_SESSION['user_client'])) {
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
            // var_dump($mail['id']);
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }

            require_once './views/gioHang.php';

        } else {
            header("Location: " . BASE_URL . '?act=login');
            die;
        }
    }
    public function deleteProduct()
{
    $gio_hang_id = $_GET['gio_hang_id'] ?? null;
    $san_pham_id = $_GET['san_pham_id'] ?? null;

    if (!$gio_hang_id || !$san_pham_id) {
        echo "Dữ liệu không hợp lệ!";
        return;
    }

    // Xử lý xóa sản phẩm
    $isRemoved = $gioHang->removeProductCart($gio_hang_id, $san_pham_id);

    if ($isRemoved) {
        header('Location: index.php?act=gio-hang');
        exit();
    } else {
        echo "Không thể xóa sản phẩm.";
    }
}
public function thanhToan(){
    {
        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
            // var_dump($mail['id']);
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }

            require_once './views/thanhToan.php';

        } else {
            header("Location: " . BASE_URL . '?act=login');
            die;
        }
    }    
    require_once './views/thanhToan.php';
}
    
}


    
    
    
    
    
