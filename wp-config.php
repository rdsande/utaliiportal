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
define( 'DB_NAME', 'utalii' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '@Rodj1234' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

	
// define( 'WP_MEMORY_LIMIT', '96M' );

define( 'FS_METHOD', 'direct' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'LX5I.xK3aE0yY||bw}dnNK(qLX*6P8+!^.+?_yAt{G>kgtvOB4PANx-PtOe&E4T5' );
define( 'SECURE_AUTH_KEY',  'M~2w?6B7(2+MnR#<b1j{$Ar<*D~4Z~Co{JW(rM`*6pp#6Tc3P;.gY^I}vqVz#AZI' );
define( 'LOGGED_IN_KEY',    '!Rmw!.Wq>K{E6>_Fsm#z0KcX7Rs{v%d/#Js9EVfx60ZlMhA}g9`;j Vgj;M4vaDd' );
define( 'NONCE_KEY',        '#%8tZ!G~}ZSf8SBy9TUYD`Phyt3W1ytcOTsiHsIOE7O_$`)<-N<LD0[<[`R,/TW`' );
define( 'AUTH_SALT',        '#G&Tv7>d!z_D[4rSNX+dMX/%gEx;t05[-YeSC?k.0>RQj,? EU_ |@ha5&GhVgNv' );
define( 'SECURE_AUTH_SALT', 'I?&TEKmjo.2c#6;MM:^nca=?XA^>!%iq?5tz:osbXFT3O^ihoV7:{ncfwY|jxWe~' );
define( 'LOGGED_IN_SALT',   'X2.TO5NZ ?2Z/.]F*WRS[l+MG][YN?{T]MdBd1ko;:^`g.u+PW:Ei#l@6NH,?g$$' );
define( 'NONCE_SALT',       'q@BjeG,{~{[nD/)wmf]>OK)$yVC~P/uB4:Oc_<NGR:^q79F|L@>b=V[8LQy&<j=U' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
