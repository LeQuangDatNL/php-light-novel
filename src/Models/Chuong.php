<?php

namespace App\Models;

class Chuong
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

    public function getListChuongByTruyen($maTruyen)
    {
        $maTruyen = (int)$maTruyen; 
        $sql = "SELECT * FROM Chuong 
                WHERE MaTruyen = $maTruyen 
                ORDER BY SoChuong ASC";
        
        $result = $this->connection->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function createChuong($maTruyen, $soChuong, $tenChuong, $noiDung)
    {
        $maTruyen = (int)$maTruyen;
        $soChuong = (int)$soChuong;
        $tenChuong = $this->connection->real_escape_string($tenChuong);
        $noiDung = $this->connection->real_escape_string($noiDung);

        $sql = "INSERT INTO Chuong (MaTruyen, SoChuong, TenChuong, NoiDung)
                VALUES ($maTruyen, $soChuong, '$tenChuong', '$noiDung')";
        return $this->connection->query($sql);
    }

    public function updateChuong($maChuong, $soChuong, $tenChuong, $noiDung)
    {
        $maChuong = (int)$maChuong;
        $soChuong = (int)$soChuong;
        $tenChuong = $this->connection->real_escape_string($tenChuong);
        $noiDung = $this->connection->real_escape_string($noiDung);

        $sql = "UPDATE Chuong SET SoChuong=$soChuong, TenChuong='$tenChuong', NoiDung='$noiDung' 
                WHERE MaChuong=$maChuong";
        return $this->connection->query($sql);
    }

    public function deleteChuong($maChuong)
    {
        $maChuong = (int)$maChuong;
        $sql = "DELETE FROM Chuong WHERE MaChuong=$maChuong";
        return $this->connection->query($sql);
    }

    public function getChuongDetail($maChuong)
    {
        $maChuong = (int)$maChuong;
        $sql = "SELECT * FROM Chuong WHERE MaChuong = $maChuong";
        
        $result = $this->connection->query($sql);
        return $result->fetch_assoc();
    }


}