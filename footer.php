<?php

$admin_footer_title = get_field('admin_footer_title', 'option');
$admin_footer_content = get_field('admin_footer_content', 'option');
                
$admin_copyright = str_replace('{year}', date('Y'), get_field('admin_copyright', 'option'));

$admin_link_li = get_field('admin_link_li', 'option');
$admin_link_ig = get_field('admin_link_ig', 'option');
$admin_link_fb = get_field('admin_link_fb', 'option');
$admin_link_tt = get_field('admin_link_tt', 'option');
?>

		<div class="c-footer">
			<div class="o-wrapper">
				<div class="c-footer__wrapper">

					<div class="c-footer__content">

						<h6><?php echo $admin_footer_title; ?></h6>
						<p><?php echo $admin_footer_content; ?></p>

                        <div class="c-footer__content-logo">
                            <img src="<?=get_template_directory_uri()?>/dist/images/charity-logo.png" alt="Registered Charity">
                        </div>


						<div class="c-footer__left-social c-social">
							<?php if ($admin_link_ig) : ?>
							<a href="<?php echo $admin_link_ig; ?>"><i class="icon-instagram"></i></a>
							<?php endif; ?>	
							<?php if ($admin_link_fb) : ?>
							<a href="<?php echo $admin_link_fb ?>"><i class="icon-facebook-f"></i></a>
							<?php endif; ?>		
							<?php if ($admin_link_li) : ?>
							<a href="<?php echo $admin_link_li; ?>"><i class="icon-linkedin"></i></a>
							<?php endif; ?>	
							<?php if ($admin_link_tt) : ?>
							<a href="<?php echo $admin_link_tt; ?>"><i class="icon-twitter"></i></a>
							<?php endif; ?>				
						</div> <!-- .c-social -->

					</div>
							

					<div class="c-footer__nav">
						<?php wp_nav_menu(array(
								'container' => false, 
								'menu' => 'Footer Nav', 
								'theme_location' => 'footer-nav'
						)); ?>
					</div> <!-- .c-footer__nav -->	

					<div class="c-footer__bottom">

						<div class="c-footer__bottom-links">

							<?php wp_nav_menu(array(
									'container' => false, 
									'menu' => 'Footer Links', 
									'theme_location' => 'footer-links'
							)); ?>

						</div>

						<div class="c-footer__bottom-copy">
							<?php echo $admin_copyright; ?>
						</div>

					</div>

				</div>
			</div>
		</div> <!-- .c-footer -->

		</div> <!-- #main -->

		<?php include 'template-parts/modal.php'; ?>
		
		<?php wp_footer(); ?>

	</body>
</html> 