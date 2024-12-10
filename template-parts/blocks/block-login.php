
<?php
    $admin_login_logo = get_field('admin_login_logo', 'option');
    $admin_login_content = get_field('admin_login_content', 'option');
    $admin_login_bg = get_field('admin_login_bg', 'option');
    $admin_login_bg_mobile = get_field('admin_login_bg_mobile', 'option');
    $redirection = get_field('redirection');
    $referrer = isset($_GET['referrer']) ? $_GET['referrer'] : false;

    if (!$referrer && $redirection) {
        $redirect_to = $redirection['url'];
    } else if ($referrer && $redirection) {
        $redirect_to = $referrer;
    } else {
        $redirect_to = home_url();
    }

?>

<div class="b-login <?php echo isset($block['className']) ? $block['className'] : ''; ?>" id="block-<?php echo $block['id']; ?>" data-aos="fade-in">

    <div class="b-login__desktop" style="background-image:url(<?=isset($admin_login_bg['sizes']['large']) ? $admin_login_bg['sizes']['large'] : ''?>)"></div>
    <div class="b-login__mobile" style="background-image:url(<?=isset($admin_login_bg_mobile['sizes']['large']) ? $admin_login_bg_mobile['sizes']['large'] : ''?>)"></div>

    <div class="b-login__wrap">
        <div class="b-login__header">
            <div class="b-login__header-logo">
                <a href="/"><img src="<?=$admin_login_logo['url']?>" alt="<?php echo bloginfo('name'); ?>"></a>
            </div>
            <div class="b-login__header-cont">
                <?=$admin_login_content?>
            </div>
        </div>
        <div class="b-login__form">
            <div id="login-message"></div>

            <form name="loginform" id="loginform" action="/wp-login.php" method="post" class="c-form">
                
                <div class="c-form__row">
                    <label for="user_login" class="hidden">Email Address</label>
                    <input type="email" name="username" id="username" autocomplete="username" class="input" value="" size="100" placeholder="Email" required/>
                </div>
                
                <div class="c-form__row">
                    <label for="user_pass" class="hidden">Password</label>
                    <div class="c-pwd-toggle">
                        <input type="password" name="password" id="password" autocomplete="current-password" spellcheck="false" class="input" value="" size="30" placeholder="Password" required/>
                    </div>
                </div>
			
                <div class="c-form__submit">
                    <div>
                        <a href="/reset-password/">Forgotten password?</a>
                    </div>
                    <div>
                        <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('ajax-login-nonce'); ?>">
                        <input type="hidden" name="redirect_to" id="redirect_to" value="<?=$redirect_to?>" />
                        <input type="submit" name="wp-submit" id="wp-submit" class="c-button c-button--primary" value="Log In" />
                    </div>
                </div>
			</p>
            </form> 

        </div>
    </div>
    
</div>