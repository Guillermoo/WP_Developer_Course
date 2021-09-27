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


if (strstr($_SERVER['SERVER_NAME'], 'fictionaluniversity.local')){
	define( 'DB_NAME', 'local' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', 'root' );
	define( 'DB_HOST', 'localhost' );
}else{

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_ykc3e' );

/** MySQL database username */
define( 'DB_USER', 'wp_v4e0r' );

/** MySQL database password */
define( 'DB_PASSWORD', 'P?0$fnZw4@4MWby?' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
}



/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '8HfdTqZGcTbBZUIuwTwjk/o498kHY2v0OSSKnxCsPkrdOIOsje9ccU9hHZedclvfK8beTD0RFJzJ9JEbXtmD2g==');
define('SECURE_AUTH_KEY',  'hTqKoMcexGyQ5EF43mIqNVDrEwRIHRrGKjwxf0Lg2ehKlp83sO7UX0FlBMd21svxJ0rKHQleHU9rdarP6lM78g==');
define('LOGGED_IN_KEY',    'lWXqQ6QpHkCf5GptnzYbiCl77GefpIjU76I3bv7lzvjicZyNPhBaBIwnBoNqlscd172L7jZBZIsAjsjsxKhUmg==');
define('NONCE_KEY',        'PRVeyPet0uvpufasPaDY1B446Ll96EOXsoZQ1M4iJawHhEP7idPMH2QGLyUuYW3RCrfYhaFuGA5Cn+YUpKbWoA==');
define('AUTH_SALT',        'VODhy/Ze5wFzVLHMRk1kyOiYeIPU0+q6IOZl7Rx2YhgZD30Jp8OT2X2D4Kj7PUF9JHxf4nqu0ZMvdbym2mKprw==');
define('SECURE_AUTH_SALT', 'cZD8uxPumAxbfJ+kqQKB863N2hlYiLIIDRlIxlpkcRTfaJVk+h5EZDJtKcVCTuqCTWo6DFIDdTajJP2wYhIXXQ==');
define('LOGGED_IN_SALT',   'WPufHzEJ0eHSdP8WVmb8uQxwbz5VsdI09rVERCKyY02UizxzJqDGQh2Eeci3lcQ1jFHUfN/uvJaXes0JTgvwqg==');
define('NONCE_SALT',       '77VpibPnX1RfG5Wvz50s8wno2cDB/jZ8ozwc3BzppN0L6E88+furfnAt2c9BNLBpFKmZDYSrDSF2ujIJCktHSQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
