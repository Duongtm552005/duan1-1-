<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // Cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Cài đặt chế độ trả dữ liệu dạng mảng kết hợp
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

function uploadFile($file, $folderUpload){
    // Đảm bảo rằng thư mục tồn tại
    if (!is_dir(PATH_ROOT . $folderUpload)) {
        mkdir(PATH_ROOT . $folderUpload, 0755, true);
    }

    // Tạo đường dẫn lưu trữ với tên file duy nhất
    $pathStorage = $folderUpload . time() . '_' . basename($file['name']);
    $from = $file['tmp_name'];
    $to = PATH_ROOT . $pathStorage;

    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }

    return null;
}

// Xóa file
function deleteFile($file){
    $pathDelete = PATH_ROOT . $file;
    if (file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}

// Xóa session sau khi load trang
function deleteSessionError(){
    if (isset($_SESSION['flash'])) {
        // Hủy session sau khi đã tải lại trang
        unset($_SESSION['flash']);
        unset($_SESSION['error']);
    }
}

// Upload Album Ảnh
function uploadFileAlbum($file, $folderUpload, $key){
    // Đảm bảo rằng thư mục tồn tại
    if (!is_dir(PATH_ROOT . $folderUpload)) {
        mkdir(PATH_ROOT . $folderUpload, 0755, true);
    }

    // Tạo tên tệp an toàn hơn
    $filename = time() . '_' . basename($file['name'][$key]);
    $pathStorage = $folderUpload . $filename;

    $from = $file['tmp_name'][$key];
    $to = PATH_ROOT . $pathStorage;

    // Kiểm tra lỗi tải lên
    if ($file['error'][$key] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($from, $to)) {
            return $pathStorage;
        } else {
            error_log('Failed to move uploaded file.');
        }
    } else {
        error_log('Upload error code: ' . $file['error'][$key]);
    }

    return null;
}


// Định dạng ngày
function formatDate($date){
    return date("d-m-Y", strtotime($date));
}

// Kiểm tra đăng nhập Admin
function checkLoginAdmin(){
    if (!isset($_SESSION['user_admin'])) { // Không có session thì chuyển về trang login
        header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
        exit();
    }
}

// Định dạng giá
function formatPrice($price) {
    return number_format($price, 0, ',', '.');
}
