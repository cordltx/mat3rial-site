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
define('DB_NAME', 'cordltx_2018');

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
define('AUTH_KEY',         'AP!;{gbMa_Dj[(g^73qj/kg4_e#|Bv)AFBu^fLK_j_iQ&m.l+DY*M>46RNgYFL}2');
define('SECURE_AUTH_KEY',  'O0EnkZ*8p0,CJ)jfeS!O)X*`7SN-yGMjrg>Ge)q#sa1}epru![YxAJV&L[!Zqa;R');
define('LOGGED_IN_KEY',    'O-{C5%PFyzZT{$WRNYnsK1]qiMYHiYX|`31_l5{0Jndb~PP8Co-}!PCWC=GZDs5.');
define('NONCE_KEY',        'baK<v0oNuFeGqkjzFD#eI(8K+)h@&^8(3$p@vd8=]k$#N=u1Gs[[<r6aNLxOo,ur');
define('AUTH_SALT',        '.8?7q}nvw(C1_VZ<FNH9@0<V `Ryj,v{%#kM?yQa;Zlv&(oS`3.=jLUc$gC?JD4&');
define('SECURE_AUTH_SALT', 'knbm#V6q>#I*d8F@hu+/z-7J`tJqPbUQ#)M.8zuwUr4eGJsR?Qodq{X#>R_*`Z2L');
define('LOGGED_IN_SALT',   'O4gf)=rfvSX)Y6Q|`AzdreBKRsec;I&=hg;N0j_QCLXzZlk!eB,e3|:[8Uu[Bk+1');
define('NONCE_SALT',       'tj1e|o{i~ 6mQrapS0J_k;WZQ A(D+TR0wDUqTw5.DnqP{S8$VaSU4da6)|.Q74@');

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
