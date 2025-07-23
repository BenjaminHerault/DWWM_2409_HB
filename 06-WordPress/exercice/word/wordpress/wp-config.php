<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'agence' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'wQT?oe~[bj_j !1T }rp$5un=2$5)$3X>MN|o4B2S0Od}E}2ZKxhccdiQm/$[=;=' );
define( 'SECURE_AUTH_KEY',  ',)enA~gLnJAmfXpEg6lSvIhzk.X|iPtb=ELDQz2C@3}XWBIHgYnUwYu:m)OPr57,' );
define( 'LOGGED_IN_KEY',    '#AXFX=KZC)m=zhF#|$9<@^rItJ&g@R~`Z.hs[g.%F]3{%AO2f?T]4W0-|JCv`wls' );
define( 'NONCE_KEY',        'R,)^/ujfF|i1#n:yy0?-J=ge[6v,x[Wzz3(~&`ZcQ<x$; wRyp1c#b1mF~tW;#21' );
define( 'AUTH_SALT',        '_*<d_S0hxr&u6)1<dJIpP^#dv9QBvH/I`~eMU*,<e)}D>d-2!d!i<S]7.cv~Nyjp' );
define( 'SECURE_AUTH_SALT', 'l%^:aXuX<=[C7Kk/(Y`y:@]!&Oc1L_<Ec9yFAc}CW2wl?mdD:sp6B~Dh&i.-?|q+' );
define( 'LOGGED_IN_SALT',   'y5%UGSee6H([Y)).gQn0D`U=>-Rs<nS8m)9s;`Ip?Rbc8rXb<Ehn%oV!Aev_|6Z/' );
define( 'NONCE_SALT',       'zM)4MuN6>c;FoFEAl4E`R+Z?o%=*U](v hN.)8$+S~=Gt_|7]--%7c-r|Jej^{k3' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
