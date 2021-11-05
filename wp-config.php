<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
if (strstr($_SERVER['SERVER_NAME'], '.local')) {
    define('DB_NAME', 'communaute');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_HOST', 'localhost');
    define('DB_CHARSET', 'utf8');
  
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', true);
    define('WP_DEBUG_DISPLAY', true);
  } else {
    define('DB_NAME', getenv('MYSQL_ADDON_DB'));
    define('DB_USER', getenv('MYSQL_ADDON_USER'));
    define('DB_PASSWORD', getenv('MYSQL_ADDON_PASSWORD'));
    define('DB_HOST', getenv('MYSQL_ADDON_HOST').":".getenv('MYSQL_ADDON_PORT'));
    define('DB_CHARSET', 'utf8');
   
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', false);
    define('WP_DEBUG_DISPLAY', false);

    // define('SMTP_USER', getenv('CC_MTA_AUTH_USER©'));
    // define('SMTP_PASS', getenv('CC_MTA_AUTH_PASSWORD'));
    // define('SMTP_HOST', getenv('CC_MTA_SERVER_HOST'));
    // define('SMTP_FROM', 'noreply@inclusion.beta.gouv.fr');
    // define('SMTP_NAME', 'La communauté de l’inclusion');
    // define('SMTP_PORT', getenv('CC_MTA_SERVER_PORT'));
    // define('SMTP_SECURE', 'tls');
    // define('SMTP_AUTH', true);
    // define('SMTP_DEBUG', 0);  
  }

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         getenv('AUTH_KEY'));
define( 'SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY'));
define( 'LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY'));
define( 'NONCE_KEY',        getenv('NONCE_KEY'));
define( 'AUTH_SALT',        getenv('AUTH_SALT'));
define( 'SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define( 'LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
define( 'NONCE_SALT',       getenv('NONCE_SALT'));
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 * define( 'WP_DEBUG', false );
 */
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_AUTO_UPDATE_CORE', false);
define('EMPTY_TRASH_DAYS', 7);
define('AUTOSAVE_INTERVAL', 86400);
define('WP_POST_REVISIONS', 1);
define('ALLOW_UNFILTERED_UPLOADS', false);
define('FORCE_SSL_ADMIN', true);
/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );


/**
 * HTTPS-related configuration, necessary for clever-cloud
 * @link https://www.clever-cloud.com/doc/deploy/application/php/tutorials/tutorial-wordpress/#ssl-configuration
*/
function check_proto_set_ssl($forwarded_protocols) {
    $secure = 'off';
    if ( strstr($forwarded_protocols , ",") ) {
        $previous = null;
        foreach ( explode(",", $forwarded_protocols) as $value ) {
            if ( $previous ) {
                trim($value) == $previous && trim($value) == 'https' ? $secure = 'on' : $secure = 'off';
            }
            $previous = trim($value);
        }
        $_SERVER["HTTPS"] = $secure;
    }else{
        $forwarded_protocols == 'https' ? $_SERVER["HTTPS"] = 'on' : $_SERVER["HTTPS"] = $secure = 'off';
    }
}

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
    check_proto_set_ssl($_SERVER['HTTP_X_FORWARDED_PROTO']);
} elseif (isset($_SERVER['X_FORWARDED_PROTO'])) {
    check_proto_set_ssl($_SERVER['X_FORWARDED_PROTO']);
}

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
