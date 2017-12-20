<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 06/12/2017
 * Time: 12:03
 */

?>


<div class="uk-background-default uk-padding-small">



	<?php if($actuel_cover): ?>

	<?php $post_cover = get_post($actuel_cover); ?>

	<div class="uk-card uk-card-default uk-card-large uk-grid-collapse uk-margin" uk-grid>
		<div class="uk-flex-last@s uk-card-media-right uk-cover-container uk-width-1-2">
			<?=  get_the_post_thumbnail( $post_cover->ID, 'full', array('uk-cover' => ''));?>
			<canvas width="600" height="400"></canvas>
		</div>
		<div class="uk-width-1-2">
			<div class="uk-card-body">

				<h2 class="uk-h1 uk-text-uppercase uk-article-titre dotdot" style="max-height: 4em;"><a href="<?php the_permalink($post_cover->ID) ?>" class="uk-display-block uk-text-break"><?= $post_cover->post_title ?></a></h2>
				<div class="uk-article-meta uk-categorie"><a href="<?= get_category_link(get_the_category($post_cover->ID)[0]->term_id);?>" class="uk-text-uppercase uk-text-bold uk-animation-shake" style="color: <?=  tr_taxonomies_field('couleur_cat', 'category', get_the_category($post_cover->ID)[0]->term_id); ?>"><?= get_the_category($post_cover->ID)[0]->name; ?></a> <br><?= get_the_date('d/m/Y', $post_cover->ID) ?></div>
				<div class="uk-grid-small uk-child-width-auto uk-margin-medium uk-animation-slide-left-small" uk-grid>
					<div class="uk-auteur">
						<?php $auteur_id = $post_cover->post_author; ?>
						Ajouté par : <a class="uk-link-reset uk-text-capitalize" href="#"><?php the_author_meta( 'display_name' , $auteur_id ); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php endif; ?>

	<?php

		$nbre_aticle = 5;

		$id_remove = [];

		$contenu = $actuel_une;

		$count = 0;
	?>



	<div class="uk-grid-small" uk-grid>
		<div class="uk-width-2-3">
			<div class="uk-grid-small uk-margin" uk-grid>
				<?php if($contenu): ?>
					<?php foreach($contenu as $content): ?>

						<?php $post = get_post($content['a_la_une']); ?>

						<?php if($count == 0): ?>
							<div class="uk-width-1-1">
								<div class="uk-card uk-card-default uk-card-small uk-card-article">
									<div class="uk-card-media-top">
										<?=  get_the_post_thumbnail( $post->ID, 'full');?>
									</div>
									<div class="uk-card-body">
										<h2 class="uk-article-titre uk-text-uppercase uk-h3 uk-text-truncate uk-margin-remove"><a href="<?php the_permalink($post->ID) ?>"><?php the_title() ?></a> </h2>
										<div class="uk-article-meta uk-categorie"><a href="<?= get_category_link(get_the_category($post->ID)[0]->term_id);?>" class="uk-text-uppercase uk-text-bold uk-animation-shake" style="color: <?=  tr_taxonomies_field('couleur_cat', 'category', get_the_category($post->ID)[0]->term_id); ?>;"><?= get_the_category($post->ID)[0]->name; ?></a> <br><?= get_the_date('d/m/Y', $post->ID) ?></div>
										<div class="uk-article-description dotdot uk-height-content uk-margin">
											<?php the_excerpt() ?>
										</div>
									</div>
								</div>
							</div>

						<?php endif; ?>


						<?php if($count >= 1): ?>
							<div class="uk-width-1-2">
								<div class="uk-card uk-card-default uk-card-small uk-card-article">
									<div class="uk-card-media-top">
										<?=  get_the_post_thumbnail( $post->ID, 'full');?>
									</div>
									<div class="uk-card-body">
										<div class="uk-grid-collapse" uk-grid>
											<div class="uk-width-5-6">
												<h2 class="uk-article-titre uk-text-uppercase uk-h5 uk-text-truncate uk-margin-remove"><a href="<?php the_permalink($post->ID) ?>"><?php the_title() ?></a> </h2>
											</div>
											<div class="uk-width-1-6">
												<div class="uk-article-titre-categorie" style="background: <?=  tr_taxonomies_field('couleur_cat', 'category', get_the_category($post->ID)[0]->term_id); ?>;">

												</div>
											</div>
										</div>

										<div class="uk-article-description dotdot uk-height-content uk-height-content-article"><?php the_excerpt() ?></div>
									</div>
								</div>
							</div>

						<?php endif; ?>


						<?php $count++; array_push($id_remove, $post->ID); ?>
						<?php wp_reset_query(); ?>
						<?php
						if($count >= $nbre_aticle){
							break;
						}
						?>

					<?php endforeach; ?>
				<?php endif; ?>

				<?php if($count < $nbre_aticle): ?>

				<?php
						$reste = $nbre_aticle - $count;

						$args = array(
							'post_type' => 'post',
							'post__not_in' => $id_remove,
							'posts_per_page' => $reste,
						);

						$the_query = new WP_Query( $args );
				?>

						<?php if ( $the_query->have_posts() ): ?>
							<?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>

								<?php if($reste == $nbre_aticle): ?>

									<div class="uk-width-1-1">
										<div class="uk-card uk-card-default uk-card-small uk-card-article">
											<div class="uk-card-media-top">
												<?=  get_the_post_thumbnail( $the_query->ID, 'full');?>
											</div>
											<div class="uk-card-body">
												<h2 class="uk-article-titre uk-text-uppercase uk-h3 uk-text-truncate uk-margin-remove"><a href="<?php the_permalink($the_query->ID) ?>"><?php the_title() ?></a> </h2>
												<div class="uk-article-meta uk-categorie"><a href="<?= get_category_link(get_the_category($the_query->ID)[0]->term_id);?>" class="uk-text-uppercase uk-text-bold uk-animation-shake" style="color: <?=  tr_taxonomies_field('couleur_cat', 'category', get_the_category($the_query->ID)[0]->term_id); ?>;"><?= get_the_category($the_query->ID)[0]->name; ?></a> <br><?= get_the_date('d/m/Y', $the_query->ID) ?></div>
												<div class="uk-article-description dotdot uk-height-content uk-margin">
													<?php the_excerpt() ?>
												</div>
											</div>
										</div>
									</div>

								<?php endif; ?>

								<?php if($reste < $nbre_aticle): ?>

									<div class="uk-width-1-2">
										<div class="uk-card uk-card-default uk-card-small uk-card-article">
											<div class="uk-card-media-top">
												<?=  get_the_post_thumbnail( $the_query->ID, 'full');?>
											</div>
											<div class="uk-card-body">
												<div class="uk-grid-collapse" uk-grid>
													<div class="uk-width-5-6">
														<h2 class="uk-article-titre uk-text-uppercase uk-h5 uk-text-truncate uk-margin-remove"><a href="<?php the_permalink($the_query->ID) ?>"><?php the_title() ?></a> </h2>
													</div>
													<div class="uk-width-1-6">
														<div class="uk-article-titre-categorie" style="background: <?=  tr_taxonomies_field('couleur_cat', 'category', get_the_category($the_query->ID)[0]->term_id); ?>;">

														</div>
													</div>
												</div>

												<div class="uk-article-description dotdot uk-height-content uk-height-content-article uk-margin"><?php the_excerpt() ?></div>
											</div>
										</div>
									</div>

								<?php endif; ?>
								<?php $reste--; array_push($id_remove, get_the_ID())?>

							<?php endwhile; ?>
						<?php endif; ?>

				<?php endif; ?>

			</div>
		</div>
		<div class="uk-width-1-3">
			<?php get_template_part( 'pubAndSocial' ); ?>

		</div>
	</div>


</div>


<?php define('ID_REMOVE', $id_remove) ?>