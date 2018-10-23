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
define('DB_NAME', 'everything');

/** MySQL database username */
define('DB_USER', 'everything');

/** MySQL database password */
define('DB_PASSWORD', '123456');

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
define('AUTH_KEY',         'M^XY==iRc.s91[a)T1`1]7HHYVF lK/X@4:)~|?THkT2]1=Z<Z#vGJoQ#{xiPAzM');
define('SECURE_AUTH_KEY',  'f9,*]xl*rxe5QR^A~KXeeOTk:F|LMS`D*]a/L}/DgQEiQPk_h~?^Td 2Qbf59rY@');
define('LOGGED_IN_KEY',    'vd9xiLFWz!A8c,&gtn&0kTz2}N]M^GD`j}c- b+k7GibC@3s5Oiz#h[Iw[^Q%}:-');
define('NONCE_KEY',        'kfgYZrg,_RD!N((Ba4_0%l@xYIyI`+CVz4-8{(W=#dy[ZOkd(X8R:f,yavpT)W>T');
define('AUTH_SALT',        'KIqH/=Q;bIyh*t*YQs._*+D)(4-SfI7G=cEokKju^DcBVdKq$T2v7-5wKR3[xV]#');
define('SECURE_AUTH_SALT', 'rh<zcGO)5:(fEk`~6IpkB;`k}tv3NBcEPzg(BU}3Ef&gn]##91`sSC+rfV0h9[*l');
define('LOGGED_IN_SALT',   'm@9?>i)1qLGMSJz,M/fkCD]8]W^YQ2q,kTj0[^TdQ4ys>M{Z(k_~vx?+?!Dq0h5.');
define('NONCE_SALT',       ')G^C})w)FEkG6P4$(s-PXPJ~`kOs<ny`G(]+G6v8{UTeD5lHfChX5WqihJx8QY$(');

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
