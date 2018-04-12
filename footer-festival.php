

<?php while ( have_posts() ) : the_post(); ?>
    <div class="uk-section uk-section-small uk-section-secondary uk-footer uk-flex uk-flex-center" style="background-image: url('<?php echo wp_get_attachment_image_url(tr_posts_field("fondimagefooter"), 'full') ?>'); background-repeat: no-repeat; background-size: cover; background-color: <?php tr_posts_field("fondcolorfooter") ?> !important;">
        <div class="uk-margin uk-grid-small uk-width-5-6@m uk-width-1-1@s" uk-grid>
            <div class="uk-width-1-3@m uk-width-1-1@s">
                <img src="<?php echo get_template_directory_uri(); ?>/image/logo-w.png" alt="" class="uk-display-block uk-margin-auto uk-margin" style="height: 50px">
                <div class="uk-width-1-1 uk-flex uk-flex-center uk-padding-small uk-padding-remove-vertical uk-margin-small">
                    <a href="#modal-center" uk-toggle class="uk-button uk-button-default uk-button-menu-reverse uk-button-small">Abonnez-vous</a>
                </div>
            </div>

            <div class="uk-width-2-5@m uk-width-1-1@s">
                <div class="uk-grid-small uk-margin-large-top uk-border" uk-grid>
                    <div class="uk-width-1-3">
	                    <?php
                            $menu_arg = array(
                                'container'       => false,
                                'container_class' => '',
                                'menu_class' => 'uk-list',
                                'theme_location' => 'footer-left-nav',
                                'items_wrap' =>'<ul id="%1$s" class="%2$s">%3$s</ul>',
                            );
                            wp_nav_menu($menu_arg);
	                    ?>
                    </div>
                    <div class="uk-width-2-3 uk-column-1-2">
	                    <?php
                            $menu_arg = array(
                                'container'       => false,
                                'container_class' => '',
                                'menu_class' => 'uk-list',
                                'theme_location' => 'footer-right-nav',
                                'items_wrap' =>'<ul id="%1$s" class="%2$s">%3$s</ul>',
                            );
                            wp_nav_menu($menu_arg);
	                    ?>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-4@m uk-width-1-1@s">
                <div class="uk-social-reverse uk-flex uk-flex-center uk-flex-left@m">
                    <ul class="uk-subnav uk-icone uk-padding-remove-vertical uk-margin-remove uk-margin-small">
                        <li><a href="<?=  tr_options_field('pc_options.facebook'); ?>" uk-icon="icon: facebook" class="uk-icon" target="_blank"></a></li>
                        <li><a href="<?=  tr_options_field('pc_options.instagram'); ?>" uk-icon="icon: instagram" class="uk-icon" target="_blank"></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

<?php endwhile; ?>

</div>
</div>

<div id="modal-center" class="uk-flex-top" uk-modal bg-close="false" esc-close="false">
    <div class="uk-modal-dialog uk-margin-auto-vertical">
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Pause Café Newsletter</h2>
        </div>
        <div class="uk-modal-body">
			<?= do_shortcode('[mc4wp_form id="22"]'); ?>
        </div>
    </div>
</div>


<?php wp_footer(); ?>

</body>
</html>