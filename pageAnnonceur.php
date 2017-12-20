<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 07/12/2017
 * Time: 17:21
 */

/* Template Name: Annonceurs */

?>


<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="uk-background-default uk-padding-small">
			<div class="uk-panel uk-padding uk-heading-categorie">
				<div class="uk-grid-small" uk-grid>
					<div class="uk-width-1-2">
						<h2 class="uk-h4 uk-heading uk-text-uppercase"><?php the_title(); ?></h2>
					</div>

				</div>


			</div>

			<div class="uk-card uk-card-default uk-grid-collapse uk-margin" uk-grid>

				<div class="uk-width-3-5">
					<div class="uk-card-body uk-border-top">

						<h2 class="uk-h3 uk-animation-slide-bottom-small uk-text-uppercase"><?php the_title(); ?></h2>

						<div class="uk-margin uk-margin-medium-bottom uk-block-content">
							<?= wpautop( get_the_content(), true ); ?>
						</div>

						<div class="uk-width-1-1 uk-flex uk-flex-center uk-padding-small uk-padding-remove-vertical uk-margin uk-article-button uk-animation-toggle">
							<a href="<?= tr_posts_field('contact') ?>" class="uk-button uk-button-secondary" style="color: #fff;">Nous contacter</a>
						</div>
					</div>
				</div>
				<div class="uk-card-media-right uk-cover-container uk-width-2-5">
					<?=  get_the_post_thumbnail( get_the_ID(), 'full', array('class' => '', 'uk-cover'=> ''));?>
					<canvas width="600" height="400"></canvas>
				</div>
			</div>


			<div class="uk-margin uk-pub">
				<?php
					if( function_exists('the_ad_placement') ) { the_ad_placement('home-footer'); }
				?>
			</div>
			<?php
				$args = array(
					'post_type' => 'partenaire'
				);

				$the_query_partenaire = new WP_Query( $args );

				if($the_query_partenaire->have_posts()):

			?>
			<div class="uk-card uk-card-default uk-card-small uk-recent">
				<div class="uk-card-header">
					<h3 class="uk-card-title">Ils nous font confiance</h3>
				</div>
				<div class="uk-card-body">
					<div class="owl-carousel owl-theme" id="owl-carousel-partenaire">
						<?php while ($the_query_partenaire->have_posts()): $the_query_partenaire->the_post(); ?>
						<div class="item uk-transition-toggle">
							<div class="uk-card uk-card-default uk-card-small">
								<div class="uk-card-media-top">
									<?=  get_the_post_thumbnail( get_the_ID(), 'full');?>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
					</div>
				</div>
			</div>

			<?php endif; ?>

		</div>



	<?php endwhile; ?>


<?php get_footer(); ?>
