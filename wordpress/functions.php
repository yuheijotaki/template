<?php





// ----------------------------------------
// スマホ振り分け
// ----------------------------------------

// スマホ振り分け
function detect_sp() {
	$agent = @$_SERVER['HTTP_USER_AGENT'];
	if (strpos($agent, "iPhone")) {
		return true;
	} else if (strpos($agent, "iPod")) {
		return true;
	} else if (strpos($agent, "Android")) {
		if (strpos($agent, "Mobile")  !== false) {
			return true;
		}
	}
	return false;
}





// ----------------------------------------
// デフォルトの出力ソース制御
// ----------------------------------------

// 不要なwp_headを削除
remove_action('wp_head', 'feed_links_extra',3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'rel_canonical');

// 絵文字の無効化
remove_action('wp_head', 'print_emoji_detection_script',7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');



// 固定ページで自動整形機能を無効化
function disable_page_wpautop() {
	if ( is_page() ) remove_filter( 'the_content', 'wpautop' );
}
add_action( 'wp', 'disable_page_wpautop' );





// ----------------------------------------
// サムネイル
// ----------------------------------------

// サムネイル カスタムサイズ
add_theme_support('post-thumbnails');
if ( function_exists( 'add_image_size' ) ) {
	add_image_size('thumb', 600, 600, true);
}





// ----------------------------------------
// カスタム投稿タイプ
// ----------------------------------------

// カスタム投稿タイプ POST_TYPE_NAME
register_post_type( 'POST_TYPE_NAME',
	array(
		'labels' => array(
			'name' => __( 'POST_TYPE_NAME' ),
			'singular_name' => __( 'POST_TYPE_NAME' )
		),
		'public' => true,
		'menu_position' => 5,
		'supports' => array('title','editor','thumbnail',
		'custom-fields','excerpt','author','trackbacks',
		'comments','revisions','page-attributes'),
		'has_archive' => true
	)
);
register_taxonomy(
	'POST_TYPE_NAME_category',
	'POST_TYPE_NAME',
	array(
		'hierarchical' => true,
		'update_count_callback' => '_update_post_term_count',
		'label' => 'POST_TYPE_NAMEのカテゴリー',
		'singular_label' => 'POST_TYPE_NAMEのカテゴリー',
		'rewrite' => array(
			'slug' => 'POST_TYPE_NAME_category'
		),
		'public' => true,
		'show_ui' => true
	)
);



//カスタム投稿タイプ RSS
function custom_post_rss_set($query) {
	if(is_feed()) {
		$query->set('post_type',
			Array( 'POST_TYPE_NAME','POST_TYPE_NAME' )
		);
		return $query;
	}
}
add_filter('pre_get_posts', 'custom_post_rss_set');



// 管理画面 ダッシュボードにカスタム投稿タイプの投稿数を表示
function my_dashboard_glance_items( $elements ) {
	foreach ( array( 'POST_TYPE_NAME','POST_TYPE_NAME' ) as $post_type ) {
		$num_posts = wp_count_posts( $post_type );
		if ( $num_posts && $num_posts->publish ) {
			$text = number_format_i18n( $num_posts->publish ).' 件';
			$postTypeLabel = get_post_type_object( $post_type )->label;
			$elements[] = sprintf( '<a href="edit.php?post_type=%1$s" class="%1$s-count"><b>%3$s</b>：%2$s</a>', $post_type, $text, $postTypeLabel );
		}
	}
	return $elements;
}
add_filter( 'dashboard_glance_items', 'my_dashboard_glance_items' );



// 管理画面 ダッシュボードにカスタム投稿タイプの投稿数 アイコン
function my_dashboard_print_styles() {
?>
<style>
#dashboard_right_now .POST_TYPE_NAME-count:before,
#dashboard_right_now .POST_TYPE_NAME-count:before {
	content: "\f109";
}
</style>
<?php
}
add_action( 'admin_print_styles', 'my_dashboard_print_styles' );





// ----------------------------------------
// Advanced Custom Fields
// ----------------------------------------

// ACF PRO オプションページ
if( function_exists('acf_add_options_page') ) {
	$option_page = acf_add_options_page(array(
		'page_title' => 'オプションページ名',
		'menu_title' => 'オプションページ名',
		'menu_slug' => 'OPTION_PAGE_NAME',
		'capability' => 'edit_posts',
		'redirect' => false
	));
}





// ----------------------------------------
// MW WP FORM
// ----------------------------------------

// エラーメッセージの文言変更
function englishform_error_message( $error, $key, $rule ) {
if ( $key === 'KEY_NAME' && $rule === 'noempty' ) return 'Please enter the item.';
return $error;
}
add_filter( 'mwform_error_message_mw-wp-form-XXXXXXXXXX', 'englishform_error_message', 10, 3 );





// ----------------------------------------
// 管理画面
// ----------------------------------------

// 管理ツールバーを常に非表示
// show_admin_bar( false );



// 管理画面にファビコンを表示
function admin_favicon() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_bloginfo('template_url').'/images/favicon.ico" />';
}
add_action('admin_head', 'admin_favicon');



// 管理画面バー コメントの削除
function remove_admin_bar_menu() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('new-content'); //新規追加ボタン
}
add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 99 );



//本体のアップデート通知を非表示
add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

//プラグイン更新通知を非表示
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );

//テーマ更新通知を非表示
remove_action( 'load-update-core.php', 'wp_update_themes' );
add_filter( 'pre_site_transient_update_themes', create_function( '$a', "return null;" ) );





?>