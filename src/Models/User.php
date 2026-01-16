<?php

namespace App\Models;

class User {
    private $connection;

    public function __construct() {
        $this->connection = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->connection->connect_error) {
            die("Kết nối thất bại: " . $this->connection->connect_error);
        }
    }

    /**
     * Tạo user mới (mật khẩu được hash)
     */
    public function create($username, $firstName, $lastName, $email, $phone, $password, $role = 'user') {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->connection->prepare(
            "INSERT INTO users (username, firstName, lastName, email, phone, password, role) 
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssssss", $username, $firstName, $lastName, $email, $phone, $passwordHash, $role);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Lấy user theo email hoặc username
     */
    public function getByEmailOrUsername($emailOrUsername) {
        $stmt = $this->connection->prepare(
            "SELECT * FROM users WHERE email=? OR username=? LIMIT 1"
        );
        $stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result ?: false;
    }

    /**
     * Xác thực đăng nhập
     */
    public function authenticate($emailOrUsername, $password) {
        $user = $this->getByEmailOrUsername($emailOrUsername);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    /**
     * Cập nhật user (hash password nếu có)
     */
    public function update($username, $data) {
        $fields = [];
        $params = [];
        $types = '';

        foreach ($data as $key => $value) {
            if ($key === 'password') {
                $value = password_hash($value, PASSWORD_DEFAULT);
            }
            $fields[] = "$key=?";
            $params[] = $value;
            $types .= 's';
        }

        $params[] = $username;
        $types .= 's';

        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE username=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    /**
     * Xóa user
     */
    public function delete($username) {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function updateRole($username, $role) {
        $stmt = $this->connection->prepare("UPDATE users SET role=? WHERE username=?");
        $stmt->bind_param("ss", $role, $username);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function getAll() {
        $result = $this->connection->query(
            "SELECT username, firstName, lastName, email, phone, role FROM users ORDER BY username DESC"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
