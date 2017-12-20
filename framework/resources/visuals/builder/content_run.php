<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 12/12/2017
 * Time: 16:35
 */
?>
<div id="<?= $data['idblockcontenu'] ?>" class="uk-section uk-padding-remove uk-run">
	<div class="uk-grid-collapse" uk-grid>
		<div class="uk-width-2-3">
			<div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow="animation: fade; autoplay: true; max-height: 300">

				<ul class="uk-slideshow-items">
					<?php foreach ($data['slidercontenu'] as $slider): ?>
					<li>
						<img src="<?php echo wp_get_attachment_image_url($slider['slidercontent'], 'full') ?>" alt="" uk-cover>
					</li>
					<?php endforeach; ?>
				</ul>

				<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
				<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

			</div>
		</div>
		<div class="uk-width-1-3">
			<div class="uk-padding uk-content-right uk-height-medium uk-height-max-medium" style="background-color: <?= $data['bgcolor']; ?>">
				<div class="uk-h3" style="color: <?= $data['colortitle'] ?>;"><?= $data['titrecontenu'] ?></div>
				<div class="uk-text-small uk-margin" style="color: <?= $data['colortexte']; ?>">
					<?= wpautop($data['textcontenu']) ?>
				</div>
				<?php if($data["linkbutton"] && $data['textbutton']): ?>
				<div class="uk-margin-medium-top">
					<a class="uk-button uk-button-default uk-button-pass" href="<?= $data["linkbutton"] ?>" style="border-radius: 50px;border: 2px solid <?= $data['colorborderbuttom'] ?>;color: <?= $data['colortextebuttom'] ?>;"><?= $data['textbutton'] ?></a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
