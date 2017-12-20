<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 09/10/2017
 * Time: 17:13
 */
global $wp_query;
?>




<?php get_header(); ?>

    <div class="uk-background-default uk-padding-small">
        <div class="uk-panel uk-padding uk-heading-categorie">
            <div class="uk-grid-small" uk-grid>
                <div class="uk-width-1-4" >
                    <h2 class="uk-h4 uk-heading uk-text-uppercase" style="line-height: 80px; height: 80px">Recherche</h2>
                </div>
                <div class="uk-width-3-4">
                    <nav class="uk-navbar-container uk-background-default" uk-navbar>
                        <div class="uk-navbar-left">

                            <div class="uk-navbar-item">
                                <form class="uk-search uk-search-navbar" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                                    <span uk-search-icon></span>
                                    <input class="uk-search-input" type="search" name="s" value="<?php the_search_query(); ?>" placeholder="Recherche sur le site .....">
                                </form>
                            </div>

                        </div>
                    </nav>
                </div>
            </div>


        </div>
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-2-3">
                <div><small><?php echo $wp_query->found_posts; ?> résultat(s) trouvé(s)</small></div>
                <div class="uk-margin">
    <?php if ( have_posts() ) { ?>
        <?php while ( have_posts() ) { the_post(); ?>

                <div class="uk-card uk-card-default uk-card-small uk-card-body uk-margin the_post">
                    <article class="uk-article">
                        <div class="uk-grid-collapse" uk-grid>
                            <div class="uk-width-5-6">
                                <h3 class="uk-article-titre uk-text-uppercase uk-h4 uk-text-truncate uk-margin-remove"><a href="<?= get_the_permalink(get_the_ID()) ?>"><?= get_the_title(); ?></a> </h3>
                            </div>
                            <div class="uk-width-1-6">
                                <div class="uk-article-titre-categorie uk-float-right" style="background: <?=  tr_taxonomies_field('couleur_cat', 'category', get_the_category(get_the_ID())[0]->term_id); ?>;">

                                </div>
                            </div>
                        </div>
	                    <?php $auteur_id = get_the_author_ID(); ?>
                        <div class="uk-article-meta" style="font-size: 12px">par <?php the_author_meta( 'display_name' , $auteur_id ); ?> le <?= get_the_date('d/m/Y', get_the_ID()) ?> .</div>

                        <div class="uk-margin-small uk-text-small dotdot uk-height-content uk-height-content-article">
	                        <?= get_the_excerpt(); ?>
                        </div>

                        <div class="uk-grid-small uk-child-width-auto uk-text-small" uk-grid>
                            <div style="font-style: italic; font-size: 12px" >
                               <div class="uk-background-secondary uk-padding-small uk-padding-remove-vertical" style="color: #ffffff"><?= displayMontant(get_post_meta(get_the_ID(), 'post_views_count')[0]) ?> Vue(s)</div>
                            </div>
                        </div>

                    </article>
                </div>

	<?php  } ?>
	<?php if($wp_query->found_posts > 10): ?>


        <div class="uk-width-1-1 uk-flex uk-flex-center uk-padding-small uk-padding-remove-vertical uk-margin-small uk-article-button uk-animation-toggle">
            <button class="uk-button uk-button-secondary loadmore uk-button-small" style="color: #fff;">Plus de resultats</button>
        </div>

        <script type="text/javascript">
            var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
            var page = 2;
            jQuery(function($) {
                $('body').on('click', '.loadmore', function() {
                    var data = {
                        'action': 'load_posts_by_ajax',
                        'page': page,
                        'security': '<?php echo wp_create_nonce("load_more_posts"); ?>',
                        'type' : 'search',
                        'query': '<?php the_search_query(); ?>'
                    };

                    $.post(ajaxurl, data, function(response) {
                        if(response === ''){
                            $('body .loadmore').removeClass('uk-button-secondary').addClass('uk-animation-shake uk-button-default').prop('disabled', true);
                        }else{
                            $('.the_post:last').after(response);
                            page++;
                        }
                    });
                });
            });
        </script>
    <?php endif; ?>

    <?php }else{
    ?>
        <div class="uk-heading-primary uk-text-center uk-padding">Aucun resultat</div>

	<?php
    }
    ?>



                </div>
            </div>
            <div class="uk-width-1-3">
	            <?php get_template_part( 'populaireWidget' ); ?>
                <hr>
			    <?php get_template_part( 'pubAndSocial' ); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>