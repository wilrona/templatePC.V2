<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 06/12/2017
 * Time: 15:47
 */

$currentcat = get_category( get_query_var( 'cat' ) );

?>

<?php get_header(); ?>
<?php set_query_var( 'actuel_dossier', tr_posts_field('actuellement_sur_dossier') ) ?>
<div class="uk-background-default uk-padding-small uk-categorie">
    <div class="uk-panel uk-padding uk-heading-categorie">
        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-1-4@m uk-width-1-3 uk-flex uk-flex-middle">
                <a href="<?= get_category_link($currentcat->parent);?>" class="uk-link-reset uk-heading"><h2 class="uk-h4 uk-heading uk-text-uppercase"><?= get_cat_name( $currentcat->parent ) ?></h2></a>
            </div>
            <div class="uk-width-3-4@m uk-width-2-3 uk-flex uk-flex-middle">
                <div class="uk-child-width-auto uk-grid-small" uk-grid>
					<?php
					$catlist_exclus = get_categories(
						array(
							'child_of' => $currentcat->parent,
							'orderby' => 'id',
							'order' => 'ASC',
							'hide_empty' => '1'
						) );
					?>
					<?php foreach ($catlist_exclus as $exclus): ?>
                        <div>
                            <div class="uk-grid-collapse <?php if($exclus->term_id === $currentcat->term_id): ?>uk-background-secondary uk-active <?php endif ?> uk-padding-small uk-padding-remove-vertical uk-padding-remove-right" uk-grid>
                                <div class="uk-width-5-6 uk-text-truncate">
                                    <a href="<?= get_category_link($exclus->term_id);?>" class="uk-link-reset"><?= $exclus->name; ?></a>
                                </div>
                                <div class="uk-width-1-6">
                                    <div class="uk-article-titre-categorie" style="background: <?=  tr_taxonomies_field('couleur_cat', 'category', $exclus->term_id); ?>;">

                                    </div>
                                </div>
                            </div>
                        </div>
					<?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
    <div class="uk-grid-small" uk-grid>
		<?php
		$args = array(
			'posts_per_page' => 2,
			'tax_query' => [
				[
					'taxonomy' => 'category',
					'terms' => $currentcat->term_id,
					'include_children' => true // Remove if you need posts from term 7 child terms
				],
			]
		);

		$posts = get_posts($args);

		$id_remove = [];

		if($posts):



			foreach ($posts as $post):
				?>
                <div class="uk-width-1-2@m uk-width-1-1@s">
                    <div class="uk-card uk-card-default uk-card-small uk-card-article">
                        <div class="uk-card-media-top">
							<?=  get_the_post_thumbnail( $post->ID, 'full');?>
                        </div>
                        <div class="uk-card-body">
                            <div class="uk-article-meta uk-categorie"><a href="<?= get_category_link(get_the_category($post->ID)[0]->term_id);?>" class="uk-text-uppercase uk-text-bold uk-animation-shake" style="color: <?=  tr_taxonomies_field('couleur_cat', 'category', get_the_category($post->ID)[0]->term_id); ?>;"><?= get_the_category($post->ID)[0]->name; ?></a></div>
                            <h2 class="uk-article-titre uk-text-uppercase uk-h5 uk-text-truncate uk-margin-remove"><a href="<?php the_permalink($post->ID) ?>"><?php the_title() ?></a> </h2>
                            <div class="uk-article-meta uk-categorie"><?= get_the_date('d/m/Y', $post->ID) ?></div>

                        </div>
                    </div>
                </div>
				<?php   array_push($id_remove, get_the_ID());
			endforeach; endif; ?>
    </div>
    <div class="uk-grid-small" uk-grid>
        <div class="uk-width-2-3@m uk-width-1-1@s">
            <div class="uk-grid-small uk-child-width-1-2 uk-child-width-1-1@s uk-margin" uk-grid>

				<?php
				$args2 = array(
					'posts_per_page' => 8,
					'post__not_in' => $id_remove,
					'paged' => 1,
					'tax_query' => [
						[
							'taxonomy' => 'category',
							'terms' => $currentcat->term_id,
							'include_children' => true // Remove if you need posts from term 7 child terms
						],
					]
				);

				$posts2 = get_posts($args2);

				if($posts2):

					$count = 0;

					foreach ($posts2 as $post):
						?>
                        <div class="the_post">

                            <div class="uk-card uk-card-default uk-card-small uk-card-article">
                                <div class="uk-card-media-top">
									<?=  get_the_post_thumbnail( $post->ID, 'full');?>
                                </div>
                                <div class="uk-card-body">
                                    <div class="uk-article-meta uk-categorie"><a href="<?= get_category_link(get_the_category($post->ID)[0]->term_id);?>" class="uk-text-uppercase uk-text-bold uk-animation-shake" style="color: <?=  tr_taxonomies_field('couleur_cat', 'category', get_the_category($post->ID)[0]->term_id); ?>;"><?= get_the_category($post->ID)[0]->name; ?></a></div>
                                    <h2 class="uk-article-titre uk-text-uppercase uk-h5 uk-text-truncate uk-margin-remove"><a href="<?php the_permalink($post->ID) ?>"><?php the_title() ?></a> </h2>
                                    <div class="uk-article-meta uk-categorie"><?= get_the_date('d/m/Y', $post->ID) ?></div>

                                </div>
                            </div>
                        </div>
						<?php if($count === 4): ?>
                        <div class="uk-pub uk-width-1-1">
							<?php
							if( function_exists('the_ad_placement') ) { the_ad_placement('home-middle'); }
							?>
                        </div>
					<?php endif; ?>

						<?php
						$count++;

					endforeach;
				endif;
				?>
            </div>
            <div class="uk-width-1-1 uk-flex uk-flex-center uk-padding-small uk-padding-remove-vertical uk-margin-small uk-article-button uk-animation-toggle">
                <a href="" class="uk-button uk-button-secondary loadmore">+ "d'article"</a>
            </div>
        </div>
        <div class="uk-width-1-3 uk-visible@m">
			<?php get_template_part( 'pubAndSocial' ); ?>
			<?php get_template_part( 'populaireWidget' ); ?>
        </div>
    </div>

    <div class="uk-margin uk-pub">
		<?php
		if( function_exists('the_ad_placement') ) { the_ad_placement('home-footer'); }
		?>
    </div>

    <div class="uk-margin">
		<?php get_template_part( 'homeDossier' ); ?>
    </div>

</div>

<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
    var page = 2;
    jQuery(function($) {
        $('body').on('click', '.loadmore', function(e) {
            e.preventDefault();
            var data = {
                'action': 'load_posts_by_ajax',
                'page': page,
                'security': '<?php echo wp_create_nonce("load_more_posts"); ?>',
                'cat' : '<?php echo $currentcat->term_id; ?>',
                'post__not_in' : <?php echo json_encode($id_remove); ?>,
                'type' : 'subcategory'
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

<?php get_footer(); ?>
