<?php

class DanhMuc
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Kết nối CSDL được khởi tạo ở đây
    }

    public function getAllDanhMuc()
    {
        try {
            $sql = 'SELECT * FROM danh_mucs';
            $stmt = $this->conn->prepare($sql); // Sử dụng $this->conn thay vì $this->db
            $stmt->execute();
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
