<?php
class TaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function checkLogin($email, $mat_khau)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Lấy kết quả dưới dạng mảng liên kết
    
            // Kiểm tra thông tin người dùng
            if ($user && password_verify($mat_khau, $user['mat_khau'])) {
                if ($user['trang_thai'] == 1) { // Chỉ xử lý nếu tài khoản đang hoạt động
                    return $user; // Trả về toàn bộ thông tin người dùng
                } else {
                    return "Tài khoản bị cấm"; // Tài khoản bị khóa
                }
            } else {
                return "Bạn nhập sai thông tin mật khẩu hoặc tài khoản"; // Sai mật khẩu hoặc tài khoản
            }
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
    
    
   public function getDetailTaiKhoan($id)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    public function register($ho_ten, $email, $mat_khau, $ngay_sinh, $so_dien_thoai, $gioi_tinh, $dia_chi, $chuc_vu_id, $trang_thai) {
        try {
            $sql = "INSERT INTO tai_khoans (ho_ten, email, mat_khau, ngay_sinh, so_dien_thoai, gioi_tinh, dia_chi, chuc_vu_id, trang_thai) 
                    VALUES (:ho_ten, :email, :mat_khau, :ngay_sinh, :so_dien_thoai, :gioi_tinh, :dia_chi, :chuc_vu_id, :trang_thai)";
            $stmt = $this->conn->prepare($sql);
    
            $stmt->execute([
                'ho_ten' => $ho_ten,
                'email' => $email,
                'mat_khau' => $mat_khau,
                'ngay_sinh' => $ngay_sinh,
                'so_dien_thoai' => $so_dien_thoai,
                'gioi_tinh' => $gioi_tinh,
                'dia_chi' => $dia_chi,
                'chuc_vu_id' => $chuc_vu_id,
                'trang_thai' => $trang_thai
            ]);
    
            return true; // Đăng ký thành công
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false; // Đăng ký thất bại
        }
    }
    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email= :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':email' => $email,
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
    
    
        
    
    

}
