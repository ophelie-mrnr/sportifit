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
define('DB_NAME', 'u475050163_tyreg');

/** MySQL database username */
define('DB_USER', 'u475050163_xutyl');

/** MySQL database password */
define('DB_PASSWORD', 'huHyvejeby');

/** MySQL hostname */
define('DB_HOST', 'mysql');

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
define('AUTH_KEY',         'shOa4waHzrs3d8r9jA6okUBhSRjYCVieopHey9jqA6ttlBlYQy0WJLgmaW8ofsFd');
define('SECURE_AUTH_KEY',  'nUiHnsDKtTSlpYyPh8xqu9F5EfUzu8CDZiIqCqOzZ0s1D93vrQ02fTXUAdHe8MnN');
define('LOGGED_IN_KEY',    'xowU3iYgNKimPxAuNm1c5yEjAb9k9fkCUjBSdI3sWZXzt27ihyhuFJAQYImUAwxM');
define('NONCE_KEY',        'xlRqpQWf3b7UiSNjn4jQ1OG52eVFUlqpUmEevZa7An6PGlXviyZMixny3qrhYGvS');
define('AUTH_SALT',        'DT1oiD5NrGds24ICGAbvc20E8Q4HwhPjfU0QHcw6DURKz2sZeKbkGj1YG1WfFzi1');
define('SECURE_AUTH_SALT', '5kNd5AZ2bbKEXehYzSgJTlEuDcQyeDCr4ZUURvxYC1e1DLfqwOuRFqeuJF6TTNrR');
define('LOGGED_IN_SALT',   'fPnQJm3fmvg207cw16tatxu5RiEAaXMdCV5B8Bqzp6QxT5MiDId9ziAFAUmNn0qW');
define('NONCE_SALT',       'rJP12S7g28Ns2q5ymjR3r3dEv5mmqVlJiWece5BYT6CBsM25S0DNb977wxnNJVwO');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'oune_';

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
