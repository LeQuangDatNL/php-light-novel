<?php

namespace App\Models;

class Truyen
{
    private $connection;

    public function __construct()
    {
        // Sử dụng các hằng số cấu hình từ config.php
        $host = DB_HOST;
        $username = DB_USER;
        $password = DB_PASSWORD;
        $database = DB_NAME;

        $this->connection = new \mysqli($host, $username, $password, $database);

        // Kiểm tra kết nối
        if ($this->connection->connect_error) {
            die("Kết nối thất bại: " . $this->connection->connect_error);
        }
        
        // Thiết lập utf8mb4 để không bị lỗi font tiếng Việt
        $this->connection->set_charset("utf8mb4");
    }
    public function getRandomTruyen() {
        $result = $this->connection->query("SELECT * FROM Truyen ORDER BY RAND() LIMIT 1");
        return $result->fetch_assoc();
    }
    // Lấy toàn bộ danh sách truyện
    public function getAllTruyen()
    {
        $result = $this->connection->query("SELECT * FROM Truyen ORDER BY MaTruyen DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Lấy thông tin chi tiết một bộ truyện theo ID

    public function getTruyenById($maTruyen)
    {
        $maTruyen = $this->connection->real_escape_string($maTruyen);
        $sql = "SELECT t.*, GROUP_CONCAT(l.TenLoai SEPARATOR ', ') AS LoaiTruyen
            FROM Truyen t
            LEFT JOIN Truyen_Loai tl ON t.MaTruyen = tl.MaTruyen
            LEFT JOIN Loai l ON tl.MaLoai = l.MaLoai
            WHERE t.MaTruyen = $maTruyen
            GROUP BY t.MaTruyen";
        $result = $this->connection->query($sql);   

        return $result->fetch_assoc();
    }
    public function searchTruyen($keyword = '', $maLoai = '') {
        $sql = "SELECT t.* , GROUP_CONCAT(l.TenLoai SEPARATOR ',') AS LoaiTruyen
                FROM Truyen t
                LEFT JOIN Truyen_Loai tl ON t.MaTruyen = tl.MaTruyen
                LEFT JOIN Loai l ON tl.MaLoai = l.MaLoai
                WHERE 1=1";

        if (!empty($keyword)) {
            $keyword = $this->connection->real_escape_string($keyword);
            $sql .= " AND t.TenTruyen LIKE '%$keyword%'";
        }

        if (!empty($maLoai)) {
            $maLoai = $this->connection->real_escape_string($maLoai);
            $sql .= " AND t.MaTruyen IN (SELECT MaTruyen FROM Truyen_Loai WHERE MaLoai = $maLoai)";
        }

        $sql .= " GROUP BY t.MaTruyen"; 

        $sql .= " ORDER BY t.MaTruyen DESC";
        
        $result = $this->connection->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Thêm truyện mới
    public function createTruyen($tenTruyen, $moTa, $tacGia, $bia)
    {
        $tenTruyen = $this->connection->real_escape_string($tenTruyen);
        $moTa = $this->connection->real_escape_string($moTa);
        $tacGia = $this->connection->real_escape_string($tacGia);
        $bia = $this->connection->real_escape_string($bia);

        $sql = "INSERT INTO Truyen (TenTruyen, MoTa, TacGia, Bia) VALUES ('$tenTruyen', '$moTa', '$tacGia', '$bia')";
        $this->connection->query($sql);
        
        header('Location: ../../index.php');
    }
    public function SortTheoSao() {
        $sql = "SELECT t.*, 
                (SELECT IFNULL(AVG(Sao), 0) FROM danh_gia WHERE MaTruyen = t.MaTruyen) AS TrungBinhSao
                FROM Truyen t
                ORDER BY TrungBinhSao DESC";
        $result = $this->connection->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
        
    }
    public function updateTruyen($maTruyen, $tenTruyen, $moTa, $tacGia, $bia)
    {
        $maTruyen = $this->connection->real_escape_string($maTruyen);
        $tenTruyen = $this->connection->real_escape_string($tenTruyen);
        $moTa = $this->connection->real_escape_string($moTa);
        $tacGia = $this->connection->real_escape_string($tacGia);
        $bia = $this->connection->real_escape_string($bia);

        $sql = "UPDATE Truyen SET TenTruyen='$tenTruyen', MoTa='$moTa', TacGia='$tacGia', Bia='$bia' WHERE MaTruyen=$maTruyen";
        $this->connection->query($sql);
        
        header('Location: ../../index.php');
    }

    // Xóa truyện
    public function deleteTruyen($maTruyen)
    {
        $maTruyen = $this->connection->real_escape_string($maTruyen);
        $this->connection->query("DELETE FROM Truyen WHERE MaTruyen=$maTruyen");
        
        header('Location: ../../index.php');
    }
}