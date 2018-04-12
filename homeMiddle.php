<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 06/12/2017
 * Time: 14:35
 */

?>


<div class="uk-grid-small" uk-grid>
	<div class="uk-width-2-3@l uk-width-1-1@s">
		<div class="uk-margin uk-pub">
			<?php
				if( function_exists('the_ad_placement') ) { the_ad_placement('home-middle'); }
			?>
		</div>
		<?php
		$args = array(
			'post_type' => 'post',
			'post__not_in' => ID_REMOVE,
			'posts_per_page' => 10,
		);

		$the_last = new WP_Query( $args );
		?>
		<?php if($the_last->have_posts()): ?>
			<div class="uk-card uk-card-default uk-card-small uk-recent">
				<div class="uk-card-header">
					<h3 class="uk-card-title">Articles Recents</h3>
				</div>
				<div class="uk-card-body">
					<div class="owl-carousel owl-theme" id="owl-carousel">
						<?php while ( $the_last->have_posts() ): $the_last->the_post(); ?>
							<div class="item uk-transition-toggle">
								<div class="uk-card uk-card-default uk-card-small uk-card-article">
									<div class="uk-card-media-top">
										<?=  get_the_post_thumbnail( $the_last->ID, 'full');?>
									</div>
									<div class="uk-card-body">
										<div class="uk-grid-collapse" uk-grid>
											<div class="uk-width-5-6">
												<h2 class="uk-article-titre uk-text-uppercase uk-h6 uk-text-truncate uk-margin-remove"><a href="<?php the_permalink() ?>"><?= get_the_title() ; ?></a> </h2>
											</div>
											<div class="uk-width-1-6">
												<div class="uk-article-titre-categorie" style="background: <?=  tr_taxonomies_field('couleur_cat', 'category', get_the_category($the_last->ID)[0]->term_id); ?>;">

												</div>
											</div>
										</div>
										<div class="uk-article-description dotdot uk-height-content uk-height-content-article uk-margin-small">
											<?php the_excerpt() ?>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>

					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="uk-width-1-3 uk-visible@l">
		<?php get_template_part( 'populaireWidget' ); ?>
	</div>
</div>
