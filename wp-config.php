<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ctmplatformtest');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'm/j>_S`c{CB.OJC,i=VBC{eafY#6vFD6Sh8(?knb0%sHti7Yh!gzGw_Z<|=KADu]');
define('SECURE_AUTH_KEY',  'SN$nFP6%OW:)h`*4&#>U<Ztu$>R2.qqpN%e1J|yZ`e$3wR]|)J@se06QD&J =Y=i');
define('LOGGED_IN_KEY',    '0D|,_0=Lk5L65#)f*2!s[m1tGyh).Kd?;qx]>DWO4F?nzbo-V:RYv=L9sbl %Lc7');
define('NONCE_KEY',        '>}PWPuq5XTt?d+Z{&qN&K]5@dYIAz!W2_e^eZcWz_grQSOe}8JtN a89D_U1(U3u');
define('AUTH_SALT',        '%Z?&.}DMJ4Z>W_s10QAx9V*|a9Fb_zp!On23S,PsX*B~@Ybezw7I[xNBb*TbGxI7');
define('SECURE_AUTH_SALT', ']d</^(U7r6LtmwkJ:9LQVx#9-m~ri?+H$Qg$>#Xy_f#:R!!,FqB}jvS3PH=Y?|5}');
define('LOGGED_IN_SALT',   'haIh}[GuJNoXP7rU;2xDdg+3@6C<Z#fzP V+|KepL}|r*@I:#JxOqt>ZWjj:MN-b');
define('NONCE_SALT',       'KY?XNH6&_/(p@b>}Zp>[KuQ%ZvKqG}z=dI^AJ@AS8Oh0bX6s@l?x;iPPfvyU>Y9d');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'ctm-platform-demo.com');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
/*
define('COOKIE_DOMAIN', $_SERVER['HTTP_HOST']);
*/

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
