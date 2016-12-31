<!DOCTYPE html>
<html lang="ja">
<head>
	<!-- <meta name="robots" content="noindex,nofollow"> -->
	<meta charset="utf-8">
	<?php
		require_once 'ua.class.php';
		$ua = new UserAgent();
	?>
	<?php if ( $ua->set() === 'tablet' ) : ?>
		<meta name="viewport" content="width=1100">
	<?php else : ?>
		<meta name="viewport" id="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
	<?php endif; ?>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="format-detection" content="telephone=no">
	<!--
	<meta name="description" content="このWebサイトの説明が入ります。">
	<meta name="keywords" content="キーワード,キーワード">
	<meta property="og:title" content="このWebサイトのタイトルが入ります。">
	<meta property="og:type" content="website">
	<meta property="og:description" content="このWebサイトの説明が入ります。">
	<meta property="og:url" content="http://XXXXXXXXXX.com">
	<meta property="og:image" content="http://XXXXXXXXXX.com/images/og.png">
	<meta property="fb:app_id" content="XXXXXXXXXXXXXXXX">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@XXXXX">
	<meta name="twitter:creator" content="@XXXXX">
	<meta name="twitter:image:src" content="http://XXXXXXXXXX.com/images/og.png">
	-->
	<title>このWebサイトのタイトルが入ります。</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" media="print,screen and (min-width: 768px)" href="./common/pc.css">
	<link rel="stylesheet" media="screen and (max-width: 767px)" href="./common/sp.css">
	<link rel="shortcut icon" href="./images/favicon.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="./common/lib.js"></script>
	<script src="./common/common.js"></script>
	<!--
		<title><?php //wp_title('/', true, 'right'); ?><?php //bloginfo('name'); ?></title>
		<link rel="alternate" href="<?php //bloginfo('rss2_url'); ?>">
		<link rel="shortcut icon" href="<?php //echo get_template_directory_uri(); ?>/images/favicon.ico">
		<link rel="stylesheet" href="<?php //echo get_stylesheet_uri(); ?>">
		<script src="<?php //echo get_template_directory_uri(); ?>/common/common.js"></script>
		<?php //echo home_url(); ?>
	-->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://cdn.jsdelivr.net/css3-mediaqueries/0.1/css3-mediaqueries.min.js"></script>
	<![endif]-->
	<?php //wp_deregister_script('jquery'); ?>
	<?php //wp_head(); ?>
</head>
<body <?php //body_class(); ?>>



<?php //wp_footer(); ?>
</body>
</html>