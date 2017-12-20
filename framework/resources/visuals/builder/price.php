<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 12/12/2017
 * Time: 15:21
 */
?>
<div id="<?= $data['idblockprice'] ?>" class="uk-section uk-section-large uk-pass" style="background-color: <?= $data['pricefondcolor'] ?>; background-image:url('<?php echo wp_get_attachment_image_url($data['pricefond'], 'full') ?>'); background-repeat:no-repeat; background-size:cover;">
	<div class="uk-container uk-container-small">
		<div class="uk-grid-small" uk-grid>
			<div class="uk-description uk-width-1-1 uk-margin">
				<?= wpautop($data['contenuprice']); ?>
			</div>
			<div class="uk-width-1-2">
				<img class="uk-responsive-height" src="<?php echo wp_get_attachment_image_url($data['imgleftprice'], 'full') ?>" alt="">
			</div>
			<div class="uk-width-1-2">
				<img class="uk-responsive-height" src="<?php echo wp_get_attachment_image_url($data['imgrightprice'], 'full') ?>" alt="">
			</div>
			<?php if($data['bordertextlink'] && $data['colortextlink'] && $data['linktext']): ?>
				<div class="uk-width-1-1 uk-flex uk-flex-center uk-margin-large-top">
					<a class="uk-button uk-button-default uk-button-pass" href="" style="border-radius: 50px;border: 2px solid <?= $data['bordertextlink'] ?>;color: <?= $data['colortextlink'] ?>;"><?= $data['linktext'] ?></a>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div>
