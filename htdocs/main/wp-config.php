<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'wordpress' );

/** Database password */
define( 'DB_PASSWORD', '123456' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'I^c&Z}DL+GHKGOO7m=Cd3%{N^ql,f7n<%0sR N7gfPDD!M!{dz$!>9tsv`(sm3Zb' );
define( 'SECURE_AUTH_KEY',  'Z|l^_S[@y< (%OSi*)t_a4,<#zwWVi4jaG 1;t/,XgU@EP_(}<,H.C;F ):7ED>F' );
define( 'LOGGED_IN_KEY',    ';n(pjl*s<?U?xKu&poYKcp6 Mx?1bKS:O.L:}H=d)BBOA^(|D}C{<QrV?q6*leQt' );
define( 'NONCE_KEY',        'kIqpV3]*8gPyr4zc g<[lD)}xFl=w8^s}R^QWf`Z5hq9p;VA&t[uoK~uREtDENqC' );
define( 'AUTH_SALT',        '~?oPj0:v[D%VSzslAsbsAzzX^,){Mz/luvDu{J@+=t_ZcV=;WSWxnBI!s@nF<J@#' );
define( 'SECURE_AUTH_SALT', 'HGxbZee_fhU;Q?zU<4Pgi_l*;FYXB7?R4;QmJ8*}LYg`+rMbj_w_5|5R_[:<~,gM' );
define( 'LOGGED_IN_SALT',   '[O{}qDRnCjy7U`l9?auT 3Qg)W%~)t.iTUSt!h9&s`Q1#R4PdoD$!?5C*kcgdY|f' );
define( 'NONCE_SALT',       'f=CLv&tZ]&/,>6:f`*`@nw55|s4u(;>A3,m4usnw!40vfe)e*.!`/htD`>t|3?FJ' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
