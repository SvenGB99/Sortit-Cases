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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define('AUTH_KEY',         'R7akcjqzGNC39SaKrNB1uG00NrmNp2IykZ0VIQ6DVp9EgxVZ3n6lV5Fv4DTN+c+Vk+w+ofbS97UNJlay9H3EBg==');
define('SECURE_AUTH_KEY',  'lKTIzIC9vIaEPR9MXenq6I03V9jCRiKtq6cYW8wbVfbwR3rPfvuslnlAErvfUx4KlYTFQUBDR6baq6VLypWtWg==');
define('LOGGED_IN_KEY',    '7oEnoIpcRYV4EGme7prECoVvvDQNDFn6AJ+mefVg6MiT1UJw9WIP25PGl90rde9z1nwi50KasjUDgeJGaqMulQ==');
define('NONCE_KEY',        '918zQZkOy+FsOXV7LFF7peagKinbvLPDWmyJgK5mX9XpSaQnnV+tkNDTCSqlmm6cJfkcOmQfZ2t7U0GQXoMj8g==');
define('AUTH_SALT',        'wNLiJ80zo7a3SSc0wGGVyP6uU88lw738OgmnrBsvPvo2erbw/L2ekpHkn0iuqcWPCc1a6CAtYcI7XHY3LhZRjw==');
define('SECURE_AUTH_SALT', 'wtGK+MwIM+ZLGBsOdoKEmc9Nfogy50zpnL8MTgMJTJQloXpUQnhrNJrU65cA2fdbDXq7Uj8JBUiqGQ3xfoEH8A==');
define('LOGGED_IN_SALT',   'uzOiPSgrZ05JkUICErUQr49SR+EOxdwKk5HLwi+k57JeLCMHCdHwb1+nKa2U129em4+dqp3Zso29iTprBdZ5/g==');
define('NONCE_SALT',       'CwW3FMVDmhDTtCBvaXTOlE6+pAAJeN22fBkLGzepQtzouCovIcX7W7QGKh+3mx1LwZFOyYJbzdMQ+LcsFKYMag==');

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
