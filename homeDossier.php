<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 06/12/2017
 * Time: 15:10
 */


$dossier = $actuel_dossier;


?>


<?php if($dossier):  $count_dossier = 0; ?>
<div class="uk-card uk-card-default uk-card-small uk-dossier">
	<div class="uk-card-header uk-padding-remove-horizontal">
		<h3 class="uk-card-title uk-heading-line uk-text-center"><span>Dossiers</span></h3>

	</div>
	<div class="uk-card-body uk-padding-remove-horizontal">
		<div class="uk-grid-small uk-child-width-1-3 uk-margin" uk-grid>
			<?php foreach ($dossier as $content):   ?>

				<?php $post = get_post($content['dossier']);   ?>
					<div>
						<div class="uk-card uk-card-default uk-card-small uk-card-article">
							<div class="uk-card-media-top">
								<?=  get_the_post_thumbnail( $post->ID, 'full');?>
							</div>
							<div class="uk-card-body">
								<div class="uk-grid-collapse" uk-grid>
									<div class="uk-width-5-6">
										<h2 class="uk-article-titre uk-text-uppercase uk-h5 uk-text-truncate uk-margin-remove"><a href="<?= get_the_permalink($post->ID) ?>"><?= get_the_title() ?></a> </h2>
									</div>
									<div class="uk-width-1-6">
										<div class="uk-article-titre-categorie" style="background: <?=  tr_taxonomies_field('couleur_cat', 'category', get_the_category($post->ID)[0]->term_id); ?>;">

										</div>
									</div>
								</div>

								<div class="uk-article-description dotdot uk-height-content uk-height-content-article uk-margin-small">
									<?= $post->post_excerpt; ?>
								</div>
							</div>
						</div>
					</div>

				<?php $count_dossier++; ?>
				<?php wp_reset_query(); ?>
				<?php
				if($count_dossier >= 3){
					break;
				}
				?>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<?php endif; ?>
