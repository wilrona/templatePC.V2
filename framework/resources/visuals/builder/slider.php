<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 12/12/2017
 * Time: 12:19
 */

?>
<?php if(!empty($data['slider'])): ?>
	<div id="<?= $data['idblockslider'] ?>" class="uk-slider">
		<div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow="ratio: 7:3; animation: push; autoplay: true; min-height: 400;">

			<ul class="uk-slideshow-items">

				<?php foreach ($data['slider'] as $slider): ?>
				<li>


					<img src="<?php echo wp_get_attachment_image_url($slider['imagefond'], 'full') ?>" alt="" class="uk-width-1-1" uk-cover>
					<div class="uk-overlay uk-overlay-primary uk-position-cover uk-flex-middle uk-flex">
						<div class="uk-container uk-container-small uk-width-4-5">
							<div class="uk-grid-large" uk-grid>
								<div class="uk-width-2-3@m uk-width-1-1@s">
									<div class="uk-heading-primary uk-text-center"><?= $slider['text']; ?></div>
									<?php if(!empty($slider['lienpass']) && !empty($slider['messagepass'])): ?>
									<div class="uk-margin-medium uk-flex uk-flex-center">
										<a href="<?php echo esc_html($slider['lienpass']); ?>" class="uk-button uk-button-default uk-button-menu"><?php echo esc_html($slider['messagepass']); ?></a>
									</div>
									<?php endif; ?>
								</div>
								<div class="uk-width-1-3@m uk-width-1-1@s uk-left">
									<div class="uk-slask">/</div>
									<div class="uk-date"><span><?= $slider['jour'] ?></span> <br> <span class="uk-text-uppercase"><?= $slider['mois'] ?></span> <?= $slider['annee'] ?></div>

								</div>
							</div>
						</div>
					</div>

				</li>
				<?php endforeach; ?>
			</ul>

			<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
			<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

		</div>
	</div>

<?php endif; ?>

