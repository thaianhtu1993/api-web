# api-web

Copy thư mục api-web vào thư mục root của host
Chỉnh sửa lại thông tin database ở trong file config/database.php 
Import file api_web.sql ở trong thư mục database 
Các api : 
- Thông tin người dùng: 
    + /api-web/user_info.php 
    + Method : GET 
    + header : token 
- Cập nhật thông tin người dùng 
    + /api-web/update_user.php
    + Method: POST
    + header : token 
    + param : username, address, tel, first_name, last_name

Hệ thống giả định môi khi user login thành công sẽ được cấp 1 token 
Token có sẵn trong db có thể sử dụng : 444ad5ab5e32724714167ec7450e640f, 2db28815b69e3150f7c3e8a7b4330bd3