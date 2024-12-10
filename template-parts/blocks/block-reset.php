
<?php
    $admin_login_logo = get_field('admin_login_logo', 'option');
    $admin_login_content = get_field('admin_login_content', 'option');
    $admin_login_bg = get_field('admin_login_bg', 'option'); 
    $admin_login_bg_mobile = get_field('admin_login_bg_mobile', 'option');
    $shortcode = get_field('shortcode');
?>

<div class="b-login <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>" data-aos="fade-in">

    <div class="b-login__desktop" style="background-image:url(<?=isset($admin_login_bg['sizes']['large']) ? $admin_login_bg['sizes']['large'] : ''?>)"></div>
    <div class="b-login__mobile" style="background-image:url(<?=isset($admin_login_bg_mobile['sizes']['large']) ? $admin_login_bg_mobile['sizes']['large'] : ''?>)"></div>

    <div class="b-login__wrap">
        <div class="b-login__header">
            <div class="b-login__header-logo">
                <a href="/"><img src="<?=$admin_login_logo['url']?>" alt="<?php echo bloginfo('name'); ?>"></a>
            </div>
        </div>
        <div class="b-login__form">
            
            <?=do_shortcode($shortcode)?>

        </div>
    </div>
    
</div>