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
define('DB_NAME', 'nlstech');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'nlstech888');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'kV+8%(;g.>k7R>?ha^xp,J(q{=|dv<Kym=BK:fBayurJ*H9`jbE26x+SYZbt>lLp');
define('SECURE_AUTH_KEY',  '(54xw&CynQQ-kk+TD]|dNeq64Qs^0?SG1PGd8oc`=,u}1<ioa2jvBi!7srNnCWXY');
define('LOGGED_IN_KEY',    '/?*mCp4>$z R&/|>6F+ftgt`L`=8]Q=I1+NvOKeNPJkeb438|s!:ayvb3e ()@R]');
define('NONCE_KEY',        's,T{pVn&|C=0rRU Hj=tD5cbW6XJ/Rjd](VLcP3[4 b3E~c (6}P;h0}/T[IA_-n');
define('AUTH_SALT',        '}Q3O3jP+TX6(x=bxv4!Z|t_k66bFTql?n9!W|$p)hdy{FjH:Di#L5++e&DqQljZM');
define('SECURE_AUTH_SALT', 'o)^1$[O#pqcN=s((~u:1dm6M-i-Au4J!QC3Qh;~W{bNM=byB[B:WD%+R6q^o>b</');
define('LOGGED_IN_SALT',   '^S?d`5jL?O6C}y,]e,c.DApBMUL:(zV7yC;t??8~<#1XM6&ZS2eol$VII%oTn]QU');
define('NONCE_SALT',       '@c:1-Vs|3|^S &hPDY,aWI&!f&BzXw=.4[v!T6EbB`:}25}f1`Vf<PN%6t:):WIs');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
