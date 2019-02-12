<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'audiobooks');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'root');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '~bwYdqE&smHW (0udSQ/*lH{e*_i;Q2>n[nq[[wUZ7v6-jI/N!Mvjf=:936_|ZKH');
define('SECURE_AUTH_KEY',  'k}Cyj<@68b^3/CuZ2^Q$.o#[1NNftL.kOBsr+f60WVJJ/zSklCWU!=95pGz*XCf@');
define('LOGGED_IN_KEY',    'nUa`f{.U)E7+@VSIj4S<5j:T!PnNf3ttgB!o=uJ7sp9dxUzDP{E,_g(3d#mu(DGZ');
define('NONCE_KEY',        '!<*}w(.P2)[{`p?]lHgA7W#mm}NVgQiN9a^mh(6Xnzy6cQc&j`4l?IDo}V.^81y5');
define('AUTH_SALT',        '~K6qTdc<U*z8d|}FjH^4IhH0Gt>|a_$Y#gITYPZz*35w4y6_`f4vQ V)ETaq}vV5');
define('SECURE_AUTH_SALT', 'BDvUkD&Hqyg[))-$#hB5.D0`Q~~fad*xP>.q2LdLdnpb8W.cw:{p1x5 38hdCM*F');
define('LOGGED_IN_SALT',   'X<>p#YA8qeM6:rB:_H5CY26C#!aONL?wWB;YOH]jW)l;O=c6ZM9-kc-Rm,E)VEmv');
define('NONCE_SALT',       '#86{GxH Zq~l[:HSFRioVEFKk 8$WOiDL,J7kAnG%f34!#[|HZwYptz*j1jW4XMQ');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
