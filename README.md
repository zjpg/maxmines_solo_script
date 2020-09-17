## MAXMINES SOLO SCRIPT
Script này RẤT RẤT ĐƠN GIẢN và thậm chí nó không cần CSDL!
Chỉ cần giải nén nó và tải lên host/vps của bạn. Sau đó làm 1 vài thay đổi trong tập tin config.json
Sau đó setup cronjob để chạy tập tin users.php mỗi phút 1 lần

Chi tiết config.json
- "site_url"        - url trang web của bạn
- "Commission"      - lợi nhuận của bạn mỗi 1MH. Ví dụ: điều này được đặt thành 0.00001 và tỷ lệ maxmines hiện tại là 0.00002496 nghĩa là bạn đang trả 0.00001496 XMR cho người dùng và nhận được 0.00001.
- "minimal_payout"  - số dư XMR tối thiểu để có thể rút
    
- "mm_site_key"    - maxmines public site key
- "mm_private_key" - maxmines private key
    
- "admin_name"      - tên tài khoản admin
- "admin_pwd"       - mật khẩu tài khoả admin

- "miner_url"       - liên kết để tải về phần mềm đã pre-config của bạn (tài liệu - https://maxmines.com/documentation/software)


Để vào trang admin (rất dễ), truy cập
http://trang-web-của-bạn.com/admin?admin_name=admin&admin_pwd=admin
