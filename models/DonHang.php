<?php
class DonHang {
    public $conn;

    // Constructor để kết nối với cơ sở dữ liệu
    public function __construct() {
        $this->conn = connectDB();
    }

    // Thêm đơn hàng
    public function addDonHang($tai_khoan_id, $ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, $phuong_thuc_thanh_toan_id, $ngay_dat, $trang_thai_id, $ma_don_hang) {
        try {
            $sql = "INSERT INTO don_hangs (tai_khoan_id, ten_nguoi_nhan, sdt_nguoi_nhan, email_nguoi_nhan, dia_chi_nguoi_nhan, ghi_chu, tong_tien, phuong_thuc_thanh_toan_id, ngay_dat, trang_thai_id, ma_don_hang)
                    VALUES(:tai_khoan_id, :ten_nguoi_nhan, :sdt_nguoi_nhan, :email_nguoi_nhan, :dia_chi_nguoi_nhan, :ghi_chu, :tong_tien, :phuong_thuc_thanh_toan_id, :ngay_dat, :trang_thai_id, :ma_don_hang)";
            
            $stmt = $this->conn->prepare($sql);
        
            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                ':email_nguoi_nhan' => $email_nguoi_nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':ghi_chu' => $ghi_chu,
                ':tong_tien' => $tong_tien,
                ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
                ':ngay_dat' => $ngay_dat,
                ':trang_thai_id' => $trang_thai_id,
                ':ma_don_hang' => $ma_don_hang
                
            ]);
        

            
            return $this->conn->lastInsertId(); // Trả về ID của đơn hàng vừa được thêm
        } catch (Exception $e) {
            echo "Lỗi SQL: " . $e->getMessage();
        }
    }
    // Thêm chi tiết đơn hàng
    public function addDetailOrder($san_pham_id, $don_hang_id, $don_gia, $so_luong, $thanh_tien) {
        try {
            $sql = "INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id, don_gia, so_luong, thanh_tien) 
                    VALUES (:don_hang_id, :san_pham_id, :don_gia, :so_luong, :thanh_tien)";
            
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute([
                ':don_hang_id' => $don_hang_id,
                ':san_pham_id' => $san_pham_id,
                ':don_gia' => $don_gia,
                ':so_luong' => $so_luong,
                ':thanh_tien' => $thanh_tien
            ]);
            
            return $result; // Trả về kết quả thực thi (true hoặc false)
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Xóa sản phẩm trong giỏ hàng đã được mua
    public function deleteCartBought($san_pham_id, $gio_hang_id) {
        try {
            $sql = "DELETE FROM chi_tiet_gio_hangs WHERE san_pham_id = :san_pham_id AND gio_hang_id = :gio_hang_id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':san_pham_id' => $san_pham_id, ':gio_hang_id' => $gio_hang_id]);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Lấy ID giỏ hàng của người dùng
    public function getCartIdByUser($user_id) {
        try {
            $sql = "SELECT id FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $user_id]);
            return $stmt->fetch(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return null;
        }
    }
}

?>
