<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'demo' );

/** Username của database */
define( 'DB_USER', 'demo' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{KBvM-,rzv3#NAyqpE6vpm$&|w@k8AeLzQNqiUO`zo]2;-c5J0wVD%o}@T3uullP' );
define( 'SECURE_AUTH_KEY',  'mR57DlA9_-u1P.T]V~y iY82(N=i/Flj2,VP(QIrgNCq8:N^[I2-I]@dF+u_QP1x' );
define( 'LOGGED_IN_KEY',    'w~rjZX/;tERYQAe5 (A7ch1enDM>Ay Xa319qtHV0R-VD`/ZzxZGL&vpMfTktlQ@' );
define( 'NONCE_KEY',        'fomi-~IPS`c=@p%!G4ZE[=cNe%VTQ$&NN3Amd#Au(Vh/^I)]ZmWh3xw^p{ZUgRUU' );
define( 'AUTH_SALT',        '2ead2E+C66hV5wVM($-tKQwg4%9mH&dQ{G{{6MA@c28Cr^ ^gFqV1u?ij]!ZSo29' );
define( 'SECURE_AUTH_SALT', 'qMe5f%|{[?dPBr%;Ox8jr[R:te]NsZ?7=y(id5GD%QZZ6^uTt+E0|R2ppN0@r ! ' );
define( 'LOGGED_IN_SALT',   '<+ VpyE[9},7t{cni*AsD-D{Yt1&R9(eVx=bg_3+6Lgn%$KWWE3QZzB(}EbBVzH_' );
define( 'NONCE_SALT',       '8+4d5tRGpI#*IP.7ldrVjNvSA{n=wU<8| Xf}BJOjE+G>R+}%SF~i;<rAvxSVa:-' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_admin';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
