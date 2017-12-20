


    <div class="uk-section uk-section-small uk-section-secondary uk-footer uk-flex uk-flex-center">
        <div class="uk-margin uk-grid-small uk-width-5-6" uk-grid>
            <div class="uk-width-1-3">
                <img src="<?php echo get_template_directory_uri(); ?>/image/logo-w.png" alt="" class="uk-display-block uk-margin-auto uk-margin" style="height: 50px">
                <div class="uk-width-1-1 uk-flex uk-flex-center uk-padding-small uk-padding-remove-vertical uk-margin-small">
                    <a href="#modal-center" uk-toggle class="uk-button uk-button-default uk-button-menu-reverse uk-button-small">Abonnez-vous</a>
                </div>
            </div>

            <div class="uk-width-2-5">
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
            <div class="uk-width-1-4">
                <div class="uk-social-reverse">
                    <ul class="uk-subnav uk-icone uk-padding-remove-vertical uk-margin-remove uk-margin-small">
                        <li><a href="<?=  tr_options_field('pc_options.facebook'); ?>" uk-icon="icon: facebook" class="uk-icon" target="_blank"></a></li>
                        <li><a href="<?=  tr_options_field('pc_options.instagram'); ?>" uk-icon="icon: instagram" class="uk-icon" target="_blank"></a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

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