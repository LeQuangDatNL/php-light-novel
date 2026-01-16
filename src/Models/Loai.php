<?php

namespace App\Models;

class Loai
{
    private $connection;

    public function __construct()
    {
        $host = DB_HOST;
        $username = DB_USER;
        $password = DB_PASSWORD;
        $database = DB_NAME;

        $this->connection = new \mysqli($host, $username, $password, $database);

        if ($this->connection->connect_error) {
            die("Kết nối thất bại: " . $this->connection->connect_error);
        }
        $this->connection->set_charset("utf8mb4");
    }

    // Lấy tất cả loại
    public function getAllLoai()
    {
        $result = $this->connection->query("SELECT * FROM loai ORDER BY MaLoai DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getLoaiById($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM loai WHERE MaLoai = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createLoai($tenLoai)
    {
        $stmt = $this->connection->prepare("INSERT INTO loai (TenLoai) VALUES (?)");
        $stmt->bind_param("s", $tenLoai);
        return $stmt->execute();
    }
    public function deleteLoai($id)
    {
        $stmt = $this->connection->prepare(
            "DELETE FROM loai WHERE MaLoai = ?"
        );
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function updateLoai($id, $tenLoai)
    {
        $stmt = $this->connection->prepare("UPDATE loai SET TenLoai = ? WHERE MaLoai = ?");
        $stmt->bind_param("si", $tenLoai, $id);
        return $stmt->execute();
    }

    // XÓA: Xóa loại theo ID
    public function deleteLoaiFromTruyen($maLoai, $maTruyen)
    {
        $stmt = $this->connection->prepare("
            DELETE FROM truyen_loai 
            WHERE MaLoai = ? AND MaTruyen = ?
        ");
        $stmt->bind_param("ii", $maLoai, $maTruyen);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
    public function addLoaiToTruyen($maLoai, $maTruyen) {
        $stmt = $this->connection->prepare("INSERT INTO truyen_loai (MaTruyen, MaLoai) VALUES (?, ?)");
        $stmt->bind_param("ii", $maTruyen, $maLoai);
        return $stmt->execute();
    }
    public function getAllLoaiTruyen($maTruyen)
    {
        $stmt = $this->connection->prepare("
            SELECT tl.MaLoai, l.TenLoai
            FROM truyen_loai tl
            JOIN loai l ON tl.MaLoai = l.MaLoai
            WHERE tl.MaTruyen = ?
            ORDER BY tl.MaLoai ASC
        ");
        $stmt->bind_param("i", $maTruyen);
        $stmt->execute();
        $result = $stmt->get_result();
        $loaiList = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $loaiList;
    }

}