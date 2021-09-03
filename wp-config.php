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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hibaycom_data' );

/** MySQL database username */
define( 'DB_USER', 'hibaycom_user' );

/** MySQL database password */
define( 'DB_PASSWORD', '](m{ZBe0?V#W' );

/** MySQL hostname */
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

define( 'AUTH_KEY',         'fH|eyyC6eL<ThzXyW4mx^Du3OO@Z2MX,uC{d(kr3IMJe]/f$rN{Tea+t@ ~T)/5{' );
define( 'SECURE_AUTH_KEY',  'O48K7vlf55W .l]#KUu)3N;MR0HG-Y0+ga49p>v<v(i%]DM-Lh&9ruu*j-Ck[MVV' );
define( 'LOGGED_IN_KEY',    '.7=OdBc~E[*f`NDSO<Ez.]XI:bs]~6RyS<ol)39W?=6od:`Y;|(-Ax,yA<:DE[^U' );
define( 'NONCE_KEY',        'V9Ippd~^h:j64i~t0oY[rlO=^](fqL)hjWu:{i.D.A<tr@U$IbQ#<5B}y(Fg<5V(' );
define( 'AUTH_SALT',        '0ln=M?>}Uby@pR9ESW4N5]%FOa^.K@]|ERy?lJWu[JE((#_`$cQF<Gsm^*R6*rpO' );
define( 'SECURE_AUTH_SALT', '>iwV$.nD{%^^Q~yK[HnS8.h67Jy)~:SLwbIe2F`,BdPm>.R(c4eol7&;{%X_~Kte' );
define( 'LOGGED_IN_SALT',   'zQQ/C,~C&c|Y.E)pQ0L=t`]iM,(> Q_<mUu986_`5p)#jP{n`!g7?ly]ZGVUQbp]' );
define( 'NONCE_SALT',       '<9D(7Wc:WKuyKE_+kYj!*s&QpPj)xw:dhBm)~)a=CV7*C[O3#y$iBa}@E6FXnLg$' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'hibay_';

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

define( 'PLL_REMOVE_ALL_DATA', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
@ini_set( 'max_input_vars' , 3000 );