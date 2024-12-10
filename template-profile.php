<?php
/**
 * Template Name: Profile Page
 */

checkLoginStatus();
$user = wp_get_current_user();
$user_meta = get_user_meta( $user->ID );
$firstname = urlencode($user_meta['first_name'][0]);
$lastname =  urlencode($user_meta['last_name'][0]);

?>
<?php get_header(); ?>

<div class="b-text-header u-hero-pt <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>">
    <div class="o-wrapper">
        <div class="b-page-hero__wrapper">        
            
            <h1 class="u-h2">Profile</h1>
            <p>You're currently logged in as <?php echo $firstname; ?> <?php echo $lastname; ?> . <a href="<?php echo wp_logout_url('/'); ?>">Logout</a></p>
        
        </div>
    </div>
</div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php the_content(); ?>
<?php endwhile; endif; ?>

<?php get_footer(); ?>