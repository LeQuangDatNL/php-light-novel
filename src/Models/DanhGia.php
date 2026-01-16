<?php

namespace App\Models;

class DanhGia
{
    private $connection;

    public function __construct()
    {
        $this->connection = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->connection->connect_error) {
            die("Kết nối thất bại: " . $this->connection->connect_error);
        }
        $this->connection->set_charset("utf8mb4");
    }

    /**
     * Lấy trung bình sao và số người đánh giá
     */
    public function getTrungBinhSao($maTruyen)
    {
        $stmt = $this->connection->prepare("
            SELECT IFNULL(AVG(Sao), 0) AS trungBinh, COUNT(*) AS soNguoi 
            FROM danh_gia 
            WHERE MaTruyen = ?
        ");
        $stmt->bind_param("i", $maTruyen);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        return $result ?: ['trungBinh'=>0, 'soNguoi'=>0];
    }

    /**
     * Lấy đánh giá của 1 user
     */
    public function getDanhGiaByUser($maTruyen, $username)
    {
        $stmt = $this->connection->prepare("
            SELECT Sao 
            FROM danh_gia 
            WHERE MaTruyen = ? AND Username = ? LIMIT 1
        ");
        $stmt->bind_param("is", $maTruyen, $username);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        return $result['Sao'] ?? null;
    }

    /**
     * Kiểm tra user đã đánh giá chưa
     */
    public function hasUserRated($maTruyen, $username)
    {
        $stmt = $this->connection->prepare("
            SELECT 1 
            FROM danh_gia 
            WHERE MaTruyen = ? AND Username = ? 
            LIMIT 1
        ");
        $stmt->bind_param("is", $maTruyen, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        return $result->num_rows > 0;
    }

    /**
     * Thêm đánh giá mới
     */
    public function insertDanhGia($data)
    {
        $stmt = $this->connection->prepare("
            INSERT INTO danh_gia (MaTruyen, Username, Sao) 
            VALUES (?, ?, ?)
        ");
        $stmt->bind_param("isi", $data['MaTruyen'], $data['Username'], $data['Sao']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Cập nhật đánh giá đã có
     */
    public function updateDanhGia($maTruyen, $username, $sao)
    {
        $stmt = $this->connection->prepare("
            UPDATE danh_gia 
            SET Sao = ? 
            WHERE MaTruyen = ? AND Username = ?
        ");
        $stmt->bind_param("iis", $sao, $maTruyen, $username);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}
