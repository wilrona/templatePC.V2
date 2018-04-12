<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 08/12/2017
 * Time: 12:00
 */
?>

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
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/app-festival.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>

<body>
<div class="uk-offcanvas-content">

    <div id="offcanvas-usage" uk-offcanvas="overlay: true">
        <div class="uk-offcanvas-bar uk-flex uk-flex-column uk-home-festival">

            <a href="<?= home_url() ?>" class="uk-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/image/logo.png" alt="" style="height: 70px;">
            </a>

            <ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
                <li><a href="<?= home_url() ?>" style="color: <?= tr_posts_field('colortexte'); ?>; border: 1px solid <?= tr_posts_field('colorbordertexte'); ?>">Accueil</a></li>
                <?php foreach (tr_posts_field('rubrique') as $rubrique): ?>
                    <li><a href="<?= $rubrique["lienrubrique"] ?>" uk-scroll style="color: <?= tr_posts_field('colortexte'); ?>; border: 1px solid <?= tr_posts_field('colorbordertexte'); ?>"><?= $rubrique["titremenu"] ?></a></li>
                <?php endforeach; ?>
            </ul>


        </div>
    </div>

    <div class="uk-home-festival">


<?php while ( have_posts() ) : the_post(); ?>
    <div class="uk-navbar-container uk-menu" style="background-image: url('<?php echo wp_get_attachment_image_url(tr_posts_field("fondimageheader"), 'full') ?>'); background-repeat: no-repeat; background-size: cover; background-color: <?php tr_posts_field("fondcolorheader") ?>;">

        <div class="uk-container uk-container-small">
            <nav class="uk-navbar uk-height-small uk-padding uk-padding-remove-horizontal" uk-navbar>
                    <div class="uk-navbar-left uk-margin-medium-top">
                        <a href="<?php get_the_permalink() ?>" class="uk-navbar-item uk-logo">
			                <?=  get_the_post_thumbnail( get_the_ID(), 'full', array('class' => 'uk-responsive-height'));?>
                        </a>
                    </div>

                    <div class="uk-navbar-center uk-margin-medium-top">
                        <ul class="uk-navbar-nav uk-visible@m">
                            <li><a href="<?= home_url() ?>" style="color: <?= tr_posts_field('colortexte'); ?>; border: 1px solid <?= tr_posts_field('colorbordertexte'); ?>">Accueil</a></li>
			                <?php foreach (tr_posts_field('rubrique') as $rubrique): ?>
                                <li><a href="<?= $rubrique["lienrubrique"] ?>" uk-scroll style="color: <?= tr_posts_field('colortexte'); ?>; border: 1px solid <?= tr_posts_field('colorbordertexte'); ?>"><?= $rubrique["titremenu"] ?></a></li>
			                <?php endforeach; ?>
                        </ul>
                        <div class="uk-flex uk-flex-center uk-flex-middle uk-hidden@l uk-width-1-1">
                            <div style="padding-top: 25px">
                                <a class="uk-navbar-toggle uk-background-default" uk-navbar-toggle-icon href="#" uk-toggle="target: #offcanvas-usage" style="height: 50px;"></a>
                            </div>
                        </div>
                    </div>

            </nav>
        </div>

    </div>

<?php endwhile; ?>