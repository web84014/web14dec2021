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
define( 'DB_NAME', 'lotuswlc_whitelotus' );

/** MySQL database username */
define( 'DB_USER', 'lotuswlc_whitelo' );

/** MySQL database password */
define( 'DB_PASSWORD', 'whitelotus@123' );

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
define( 'AUTH_KEY',         'y0.Ifsjxf&:$`(v=cws@xbm)]q}Z]MBx1@L3(U{L1[`pIjM@@UEYBh$P8q)ag+]|' );
define( 'SECURE_AUTH_KEY',  '}YXo]%_j_^ioZaR+x(Xaab_&P4}_jn6l-ClAw^tAhKU!E<D(P?e$DFH#`B(r{6Yk' );
define( 'LOGGED_IN_KEY',    'QFr4USW%1ng4>H*7mSroa.1U4kVa1=YyzEL8qa~I?Z0IgStKj|`TUQu`mh/;!),s' );
define( 'NONCE_KEY',        '3!V>d,4*|KF}Y&-xV{+F$(&6YCRMA=d.a %!0?{&6E.iE/.)oTiyBIP!anns}x,M' );
define( 'AUTH_SALT',        '{;b0QSh)WnXi(6yR^90p>Y]D%b76/49#FyVq9*5k4`iP.[n/ ]@`yU`#y.*kO?_<' );
define( 'SECURE_AUTH_SALT', 'tVU1mtpdfzzK3e(eN3soJf5GkQoBg^2y3.sl^~J:B vnjQ[n,Q)9 E#q[U])oKm#' );
define( 'LOGGED_IN_SALT',   'HF~GjjMCR2k%m9^H`mz<`;!!$*!j8lv]Jo.-Y3`KCK?S:ZE@H?A+#vsr,3aM?_|a' );
define( 'NONCE_SALT',       '),(.%2^pX_hs&-H}z VGN7bUx`=)Veto8d5%z=4EAUx9<%!EH~BFM;H+Q1.JFHst' );

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



define( 'MEDIA_TRASH', true );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
