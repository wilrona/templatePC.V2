<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 12/12/2017
 * Time: 15:00
 */

?>
<div id="<?= $data['idblockpresentation'] ?>" class="uk-section uk-section-large uk-representation" style="background-color: <?= $data['fondcolorpresentation'] ?>; color: <?= $data['colortextpresentation'] ?> ;">
	<div class="uk-container uk-container-small">
		<div class="uk-column-1-2">
			<?= wpautop($data['contentpresentation']); ?>
		</div>
	</div>
</div>
