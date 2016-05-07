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
// define('DB_NAME', 'onemusictoday');
define('DB_NAME', 'onemusictodaybd');

/** MySQL database username */
// define('DB_USER', 'root');
define('DB_USER', 'thallesfreitas');

/** MySQL database password */
define('DB_PASSWORD', 'q1w2e3r4');

/** MySQL hostname */
define('DB_HOST', 'mysql.onemusic.today');

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
define('AUTH_KEY',         '&o0KC:,y{92p+i==6W)+mo5+X>kN#U-aR@o,D0o}5]7.3;Ar|Lk8FTC#BQq@f9LB');
define('SECURE_AUTH_KEY',  'Lvcpd.tQ#(JT{r`o*T}m#7a~./LausSBDT;q/^9(AI^:Dz#`onRK8}9_Y5EI3NPv');
define('LOGGED_IN_KEY',    'I^0Gct> z`[t[V{=AD<2@<>(5(V&{wrT;B^PN:gYnehV)QJa@s4pyO`vVJ4i:Mr{');
define('NONCE_KEY',        'O5z|D5emh_.<?Qm%h7:Sy:xRTc~#+)gFvxOJ4jy:t~*hOsgPZzXp/]NZRh?c|]K5');
define('AUTH_SALT',        'u?yzvBVajuM^G?u^uZ|*euuLsJR?@7]ekwCf,-RsOA=Us~ZMf8(.a4m]Pi_S!Q-O');
define('SECURE_AUTH_SALT', '46p+=3!_~u=weJ?#PWKsB]^~z-!7W`R?7<IDZDZE)h@*d+l|sA<Aiaol%s0AMhsx');
define('LOGGED_IN_SALT',   '(V, vz45lU%dB9r:VpBSi5*9Xr(iV%o*ONQY,il3Kc7lm}G)s2czj;?3,`;4JS89');
define('NONCE_SALT',       'i,}qj@,z8Z0C<4>_*>katB55f<qju^~X~p.DVQ.Q$d)Xv*m ,eaO%w3Bq?hk(7zp');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_onemusictoday';

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
