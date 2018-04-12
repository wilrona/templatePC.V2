<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 07/12/2017
 * Time: 16:31
 */

/* Template Name: Qui sommes nous */


?>


<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="uk-background-default uk-padding-small">
			<div class="uk-panel uk-padding uk-heading-categorie">
				<div class="uk-grid-small" uk-grid>
					<div class="uk-width-1-2@m uk-width-1-1">
						<h2 class="uk-h4 uk-heading uk-text-uppercase"><?php the_title(); ?></h2>
					</div>

				</div>


			</div>

		<?php
			$contenu = tr_posts_field('blocks');
		?>
		<?php if($contenu): ?>


			<div class="uk-card uk-card-small" >
				<div class="uk-card-body uk-padding-remove">
					<div class="uk-child-width-1-2@m uk-child-width-1-1 uk-grid-small" uk-grid>

						<?php foreach($contenu as $content): ?>
						<div class="">
							<div class="uk-block uk-padding-small">
								<h3 class="uk-h1"><?= $content['titre'] ?></h3>
								<div class="uk-block-content">
									<?= $content['contenu']; ?>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

		<?php endif; ?>

			<div class="uk-margin uk-pub">
				<?php
					if( function_exists('the_ad_placement') ) { the_ad_placement('home-footer'); }
				?>
			</div>

		</div>

	<?php endwhile; ?>


<?php get_footer(); ?>
