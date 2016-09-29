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

define('DB_NAME', 'wordpress');



/** MySQL database username */

define('DB_USER', 'root');



/** MySQL database password */

define('DB_PASSWORD', 'test');



/** MySQL hostname */

define('DB_HOST', 'db:3306');



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

define('AUTH_KEY',         '8c51d40cc1425bd14ce474ee6334629a3e24a4f5');

define('SECURE_AUTH_KEY',  '56789f64e91dfb73bf8027166d6b66275d6ab5de');

define('LOGGED_IN_KEY',    '5612d2cac545d965f3ade3ebea57042b840bf3d0');

define('NONCE_KEY',        '740511d845aef438ad862ee33b6870da5e4ac04d');

define('AUTH_SALT',        '192c652113e33bf8befb455c4261950f7de614bc');

define('SECURE_AUTH_SALT', 'fe3a88bcd7eb6465bab6ead693e6b3e9e53d8ebc');

define('LOGGED_IN_SALT',   '966e166f000bf22328840819895b3b1247fb3db3');

define('NONCE_SALT',       'c53afc7f93653df3a0317556c9fcdc5cf61f4133');



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

define( 'WP_DEBUG_LOG', false);
define( 'WP_DEBUG_DISPLAY', false);
define('FS_METHOD', 'direct');
