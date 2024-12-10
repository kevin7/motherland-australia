<?php
/**
 * Template Name: Connect Page
 */

?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="theme-color" content="#FFF9F4">
		<title><?php wp_title(' | '); ?></title>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<?php wp_head(); ?>
		<?php echo $admin_tracking_header ?>
	
	</head>
	<body <?php body_class(implode(' ', siteClasses()) . ($admin_pb_enable ? 'has-promobar' : '') ); ?> itemscope itemtype="http://schema.org/WebPage">

        <script>
            window.onload = function() {
                window.location.href = "https://motherlandconnect.org.au/";
            };
        </script>

		
		<?php wp_footer(); ?>

	</body>
</html> 