<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'xercewwv_xerceswebsite');

/** MySQL database username */
define('DB_USER', 'xercewwv_xbnews');

/** MySQL database password */
define('DB_PASSWORD', 'Xerces@1985');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
//define('DB_CHARSET', 'utf8mb4');
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME','http://xercesblue.in');
define('WP_SITEURL','http://xercesblue.in');

//update_option('siteurl', 'http://newstest10.tk' );
//update_option('home', 'http://newstest10.tk' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|XBcB;g#wp:AK&qrgeS9BJ7:ex2:*|1{`yu@nYPwG7rgVUzANx#inpZL?DD|mO9F');
define('SECURE_AUTH_KEY',  'JXH/H>tV3c(|9BYT_}+pv7Oe93?(e|U-@7LxRB8rrZK/L+y$ABgjpX^$|c`SoCuO');
define('LOGGED_IN_KEY',    '`YSplLnrFy1CT^/}h(:KhmKgsP<p*#/?+>tl=c:s3l_tGxxi:!@5ZsRLBP*^xr2)');
define('NONCE_KEY',        '*VoXELr?@|c!=wO 5Fz#+T,.bL.<5^S{S4gn;mM?@sj9/1#*OEb_Mj.V,=4A3q$s');
define('AUTH_SALT',        '-)|62U7Y`$2`bF!o45vB+.6cc<.U#5TLNAL+FT~Ms|G6v2itRNNqA5WX.QNI7C/1');
define('SECURE_AUTH_SALT', 'BtK]e-@Dxrs+:-+CRhH`+CoMSc[]Qnx>YHU?>D`>xu,lWCqX-0y~s;=/juJL [;k');
define('LOGGED_IN_SALT',   '~9mJ;)b:eEFvew2^JAs*MsSt&|zvJ5~)Y>pEmJ|*E{/Szgtq%R(t&0n_e%I|vx f');
define('NONCE_SALT',       'O#21@_%)` |%Pu4A1*J^AlZ!os8s2-b1/!g|?sQrU`)ISh3/78)Y1cFh$n}D|[4%');

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

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');