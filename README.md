# Website Đọc Light Novel (PHP)

Website đọc Light Novel được xây dựng bằng PHP theo mô hình MVC.  
Dự án nhằm phục vụ mục đích học tập, đồng thời thể hiện khả năng xây dựng ứng dụng web backend với PHP và MySQL.

---

## 🎯 Mục tiêu dự án
- Xây dựng website đọc truyện Light Novel hoàn chỉnh
- Áp dụng mô hình MVC trong PHP
- Rèn luyện kỹ năng lập trình backend với PHP và MySQL
- Quản lý truyện, chương và người dùng

---

## ✨ Chức năng chính

### 👤 Người dùng
- Đăng ký / Đăng nhập
- Xem danh sách truyện
- Xem chi tiết truyện
- Tìm kiếm truyện theo tên / thể loại / số sao
- Đọc chương truyện
- Đánh giá sao (từ 1 đến 5)
- Chức năng chọn truyện ngẫu nhiên

### 🛠️ Quản trị (Admin)
- Thêm / sửa / xóa truyện
- Thêm / sửa / xóa chương
- Thêm / sửa / xóa thể loại truyện
- Quản lý nội dung truyện

---

## 🧰 Công nghệ sử dụng
- PHP 8
- Composer (autoload & dependency management)
- Mô hình MVC
- MySQL
- HTML, CSS, JavaScript
- Bootstrap


## 📂 Cấu trúc thư mục

Project/
- config/        # Cấu hình ứng dụng và kết nối cơ sở dữ liệu
- public/        # Tài nguyên public (CSS, JS, hình ảnh)
- src/           # Controller, Model, Core logic
- templates/     # Giao diện người dùng (View)
- vendor/        # Thư viện Composer (không upload GitHub)
- composer.json
- index.php