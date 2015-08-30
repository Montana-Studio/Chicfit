<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'chicfitpublic');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '$=R@?j-rr*gpUF$`fybUuD%,eu|(+6p}p+2]wP68~(ZV)t35vO2.J*6h46R6jd{&');
define('SECURE_AUTH_KEY',  'xrhRs_4~3t$e+}Ds8A[%%_I0P/4;l6@%^b:ES&fwP]E0(Gx^} Tadnafr<)aU)pO');
define('LOGGED_IN_KEY',    'V|i4o@gK7<nQW0iBIh_E{8o(3-`A|e~5,@kWlX0;x:FTu6w6L{@Rv>MV-B,:cN;I');
define('NONCE_KEY',        'A|48ciQBIOx`fBGby)cOY,C[jZ5DJ%?UbsOW#Y`:}V9F_vK[fmF:-c;oX+dE|.&m');
define('AUTH_SALT',        'C*+pOx-$TQ-H{8i~p7c_M=-mFAB3h%-N$ b&.^PC;KniwtSMn-|Y[=@.qxLFiiz|');
define('SECURE_AUTH_SALT', '9hV{/0J5C]x9=>6-uJPo~9BqNKIBKu$FT]em+<G_p*nd<+r AWP]C3k9_+Ut9kzR');
define('LOGGED_IN_SALT',   'd3D%*y[i})9>-Z>M59Zcb<-+8<vCg0D*rqU=h61:3xr[7@ASNyD~63g9xB=J-@R7');
define('NONCE_SALT',       'Gs[5oL!5_UOaLMNYlwr+P-)||c=O1JjC^ g3R/_,$D}rbS~qUM7ME4[83xw 24L}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
