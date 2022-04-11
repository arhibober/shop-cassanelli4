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
define( 'DB_NAME', 'shop-cassanelli3' );

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
define( 'AUTH_KEY',         'I6{j+|0+{*|fK Bl:#OQPcyc31c%S@%fzIDY@;XLChH.`74JJm}Q{Dpo)FZmw@T%' );
define( 'SECURE_AUTH_KEY',  '&LkS*YVI6Jv57C]Bm??8Q[g&oxUc6g0EK-cqY&aF-k_{pRB6E_ZB_=YLZOR~6-~3' );
define( 'LOGGED_IN_KEY',    'M_L-)[Bqp(92Lp^Pt3q49rdN5U*TK2B>LH$i3{X8o1+#a-K3J[C*62F%8l>e@#n.' );
define( 'NONCE_KEY',        ':i6(-j/pQ7Dp}VOY]kBbSnn8jD,]FY8^wzi-*YD4mj6z*3=CO-UEh$?KX4e|Gqf=' );
define( 'AUTH_SALT',        '6x5Yb}@@%.e2FMimuh|WyVNk%/{t}Wu*1k3Ht_~6;.wwotg,sM$/n(}xiyEl]7Hg' );
define( 'SECURE_AUTH_SALT', 'E+Dpg);+%/uQ$u>:v1XwL*~*76VIh@:CNLc+iCFg_t.<^&],|~7RmcEe;h`0|b$o' );
define( 'LOGGED_IN_SALT',   '2kpM8,Xj;C|+6.!JeN#pX0f79EZWn9 zVt*sA<0Ew=geDB)~,[c>]{0q*uPP&G{]' );
define( 'NONCE_SALT',       '-EP3VKuF^>b$nVQRC]34:C=f(j1_yO9+?/`-zH[)LEW&BjtdantO/7uLkRROGp0L' );

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
