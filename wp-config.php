<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //

/** WordPress数据库的名称 */
define('DB_NAME', $_SERVER['DB_NAME']);

/** MySQL数据库用户名 */
define('DB_USER', $_SERVER['DB_USER']);

/** MySQL数据库密码 */
define('DB_PASSWORD', $_SERVER['DB_PWD']);

/** MySQL主机 */
define('DB_HOST', $_SERVER['DB_HOST']);

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'gO|bA/WF*8Y)N1S$]ij*uH?P;5+^)JPTk1<S#N;!,4ktn|05@J%N}Mh*S#M,2+x/');
define('SECURE_AUTH_KEY',  'z?eRol5z_60Q?0:>t{j4aj<6sdWrqK+*5XNv(p&)!UvZ9a;;YGy}AR$dx*/1W2ou');
define('LOGGED_IN_KEY',    'X<pEDll lcTW88&VTn]a1~r?nrX4IP[xfEu*Q&yV]u?W~{n|)|je(.|Bg0yVt^E{');
define('NONCE_KEY',        '/H&>jAPIsM9%E15b+-TVrgb^]kgx?.|rmN$j:d<+*{oRq`>iG0:ejhX?BJhi@Y~1');
define('AUTH_SALT',        'q.qt_:w3bSvEZ{|jd5Ci>VG7` )LBCH=GGN*M/98[a0[KIyh7x8[w|l#<445+yiZ');
define('SECURE_AUTH_SALT', '*gS}k&<8:A]9uze@%QWA]V=[klE_r__}d0K[Y=;-$E`Oad{z~^EoR0_}$R%1j! p');
define('LOGGED_IN_SALT',   'I3eI2qH|GKZIayPoW+`eHJ]I@qYuki(O/X#EIb2THV>vUxz3i:XR3VzdBAPMG}vZ');
define('NONCE_SALT',       '8CRZ6,=a#RM_|}rM$a<fZfO*3nrcS]9(/yS4qssVyU<ZvtfXmh1}R/9kJTXOhl6b');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Override default file permissions */
if(is_admin()) {
	add_filter('filesystem_method', create_function('$a', 'return "direct";' ));
	define( 'FS_CHMOD_DIR', 0751 );
}

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
