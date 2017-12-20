<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title>
		<?php if ( is_category() ) {
			single_cat_title(); echo ' | '; bloginfo( 'name' ); echo ' - '; bloginfo( 'description' );
//	    } elseif ( is_tag() ) {
//		    echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
//	    } elseif ( is_archive() ) {
//		    wp_title(''); echo ' Archive | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			echo 'Recherche pour &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' ); echo ' - '; bloginfo( 'description' );;
		} elseif ( is_home() || is_front_page() ) {
			bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
//	    }  elseif ( is_404() ) {
//		    echo 'Error 404 Not Found | '; bloginfo( 'name' );
		} elseif ( is_single() ) {
			wp_title(''); echo ' | '; bloginfo( 'name' ); echo ' - '; bloginfo( 'description' );
		} else {
			wp_title(''); echo ' | '; bloginfo( 'name' ); echo ' - '; bloginfo( 'description' );
		} ?>
	</title>
	<meta http-equiv="x-ua-compatible" content="ie=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/image/favicon.png" />
	<?php
		wp_head();
	?>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>
<?php



    if(tr_options_field('pc_options.bgcolor')){
        $color = tr_options_field('pc_options.bgcolor');
    }
    else{
        $color = '#000000';
    }


?>
<body style="background-color: <?= $color ?>;">
<?php
    $imgid = tr_options_field('pc_options.bgimg');
?>
<div class="uk-padding-large uk-padding-remove-horizontal" style="background-image:url('<?php echo wp_get_attachment_url($imgid); ?>'); background-repeat: no-repeat; background-size: contain;">

	<div class="uk-container uk-container-small uk-menu  uk-padding-medium uk-margin-large-top">
		<nav class="uk-navbar uk-padding-small  uk-background-default uk-padding-remove-horizontal" uk-navbar="">
			<div class="uk-navbar-left uk-width-3-4 uk-padding-small uk-padding-remove-vertical">
				<div class="uk-display-block uk-width-1-1 uk-margin-top">
					<a href="<?= home_url() ?>" class="uk-logo">
						<img src="<?php echo get_template_directory_uri(); ?>/image/logo.png" alt="" style="height: 70px;">
					</a>
				</div>
				<div class="uk-hr uk-width-1-1 uk-hr-heading"></div>
				<div class="uk-flex uk-flex-right uk-width-1-1">
					<?php
                        $menu_arg = array(
                            'container'       => false,
                            'container_class' => '',
                            'menu_class' => 'uk-subnav uk-subnav-pill uk-margin-remove',
                            'theme_location' => 'header-nav',
                            'items_wrap' =>'<ul id="%1$s" class="%2$s">%3$s</ul>',
                        );
                        wp_nav_menu($menu_arg);
					?>
				</div>
			</div>
			<div class="uk-navbar-right uk-width-1-4 uk-flex uk-flex-center">
				<div class="uk-width-1-1">
					<div class="uk-grid-collapse" uk-grid>
						<div class="uk-width-expand">
							<ul class="uk-subnav uk-icone uk-padding-remove-vertical uk-margin-remove">
								<li><a href="<?=  tr_options_field('pc_options.facebook'); ?>" uk-icon="icon: facebook" class="uk-icon" target="_blank"></a></li>
								<li><a href="<?=  tr_options_field('pc_options.instagram'); ?>" uk-icon="icon: instagram" class="uk-icon" target="_blank"></a></li>
							</ul>
						</div>
						<div class="uk-width-auto">
							<ul class="uk-navbar-nav uk-icone uk-icone-noborder">
								<li><a href="#modal-full" uk-icon="icon: search" class="uk-icon" uk-toggle></a></li>
							</ul>
						</div>
					</div>
					<div class="uk-grid-collapse uk-child-width-1-2 uk-margin-remove" uk-grid>
                        <?php
                        $args = array(
	                        'post_type' => 'magazine',
	                        'posts_per_page' => 2,
                        );

                        $the_query_mag = new WP_Query( $args );

                        if($the_query_mag->have_posts()):
                            while ($the_query_mag->have_posts()): $the_query_mag->the_post();
                        ?>
                            <div class="uk-padding-small">
                                <a href="<?php tr_posts_field("url") ?>" target="_blank"><?php echo wp_get_attachment_image(tr_posts_field("img_courte"), 'full', false, array('class' => 'uk-img-pc')); ?></a>
                            </div>
                        <?php
                            endwhile;
                        endif;
                        ?>
					</div>
				</div>
				<div class="">
					<a href="#modal-center" uk-toggle class="uk-button uk-button-default uk-button-menu uk-display-block">Abonnez-vous</a>
				</div>
			</div>

		</nav>
		<div id="modal-full" class="uk-modal-full uk-modal uk-modal-search" uk-modal="">
			<div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" uk-height-viewport>
				<button class="uk-modal-close-full" type="button" uk-close></button>
				<form class="uk-search uk-search-large uk-width-1-2 uk-box-shadow-small" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
					<input class="uk-search-input uk-text-center" type="search" name="s" placeholder="Recherche sur le site ..." autofocus value="<?php the_search_query(); ?>">
				</form>
			</div>
		</div>

	</div>



    <div class="uk-container uk-container-small uk-padding-remove">
        <div class="uk-pub">
            <?php
                if( function_exists('the_ad_placement') ) { the_ad_placement('home-header'); }
                ?>
        </div>

    </div>


    <div class="uk-container uk-container-small">
