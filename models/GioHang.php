<?php
class GioHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getGioHangFromUser($id)
    {
        try {
            $sql = 'SELECT * FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':tai_khoan_id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function getDetailGioHang($id)
    {
        try {
            $sql = 'SELECT chi_tiet_gio_hangs.*, 
                    san_phams.ten_san_pham, 
                    san_phams.hinh_anh,
                    san_phams.gia_san_pham,
                    san_phams.gia_khuyen_mai
                    FROM chi_tiet_gio_hangs
                    INNER JOIN san_phams ON chi_tiet_gio_hangs.san_pham_id = san_phams.id
                    WHERE chi_tiet_gio_hangs.gio_hang_id = :gio_hang_id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':gio_hang_id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function addGioHang($id)
    {
        try {
            $sql = 'INSERT INTO gio_hangs (tai_khoan_id) VALUE (:id)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function updateSoLuong($gio_hang_id, $san_pham_id, $so_luong)
    {
        try {
            $sql = 'UPDATE chi_tiet_gio_hangs
                    SET so_luong = :so_luong
                    WHERE gio_hang_id = :gio_hang_id
                    AND san_pham_id = :san_pham_id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':so_luong' => $so_luong,
                ':gio_hang_id' => $gio_hang_id,
                ':san_pham_id' => $san_pham_id
            ]);

            return true;
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function addDetailGioHang($gio_hang_id, $san_pham_id, $so_luong)
    {
        try {
            $sql = 'INSERT INTO chi_tiet_gio_hangs (gio_hang_id, san_pham_id, so_luong) 
            VALUE (:gio_hang_id, :san_pham_id, :so_luong)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':so_luong' => $so_luong,
                ':gio_hang_id' => $gio_hang_id,
                ':san_pham_id' => $san_pham_id
            ]);

            return true;
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }
    // Model xử lý giỏ hàng
    public function deleteChiTietGioHang($id)
    {
        try {
            $sql = "DELETE FROM chi_tiet_gio_hangs WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getSanPhamByDanhMuc($danh_muc_id) {
        try {
            $sql = 'SELECT * FROM san_phams WHERE danh_muc_id = :danh_muc_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':danh_muc_id' => $danh_muc_id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    
    public function getAllSanPham() {
        try {
            $sql = 'SELECT * FROM san_phams';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    
    
    
    
}

