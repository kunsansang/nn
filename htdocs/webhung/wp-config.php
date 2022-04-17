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
define( 'DB_NAME', 'webhung' );

/** Username của database */
define( 'DB_USER', 'webhung' );

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
define( 'AUTH_KEY',         'w{b]D>! NRFJi/6!KSAU<K; >_ER&*(?GDDUJ.k,FS]?Z!mz8z#ibc~aqBY-QNtq' );
define( 'SECURE_AUTH_KEY',  'NN&[NSM2-$@FgS(t9O=[l$>y|i}Dw0/Btx54Hwlza -Ns M/wH8tZk_C.oPVu^@s' );
define( 'LOGGED_IN_KEY',    'W%5=$RrI2P84Pq:xt@>s3-_|024crDw3zBZ#_Pdd `}oCXQyUr{?Z5io$6b~E[d:' );
define( 'NONCE_KEY',        'xk&;x/=c*J}Q@5;@rRCqbTvGl>^U-@I07}^<(&{&JE >s%4AK;#T0qZ/~PZF~c9`' );
define( 'AUTH_SALT',        'cfl 6[GK+_fiqF539c1%Zl9<B4u-z/+i1A;@(VmYmPtpXce24xo43aEbc27avXvw' );
define( 'SECURE_AUTH_SALT', ',@e`&5`FvsSizQo6x)hi)Hwi+lK{Ey61@Rqy1ypRcS)|su1JeR*F`vAn|wc{=PEz' );
define( 'LOGGED_IN_SALT',   'mT4NgLvb43!X49A6lL)F,w;<ni<xj.wlA;sQc4(,rwoJvw7*kNeUJI1|cQDw*)3o' );
define( 'NONCE_SALT',       'y[u$g<8y8b[jf#iHIG{A&h1egUPJ7T[FP:.M>dpOvH&bCA-%~Dq*Hh2aUvtyn<!i' );

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
