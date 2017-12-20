<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 06/12/2017
 * Time: 13:01
 */

?>


<div class="uk-position-relative uk-pub">
	<?php
		if( function_exists('the_ad_placement') ) { the_ad_placement('pub-laterale'); }
	?>
</div>
<div class="uk-instagram uk-card uk-card-default uk-card-small uk-margin">
	<div class="uk-card-header">
		<div class="uk-grid-small uk-flex-middle" uk-grid>

			<div class="uk-width-expand">
				<span class="uk-card-title">INSTAGRAM</span>
			</div>
			<div class="uk-width-auto">
				<span class="uk-margin-small-right" uk-icon="icon: instagram"></span>
			</div>
		</div>
	</div>
	<div class="uk-card-body uk-padding-remove">
		<?= do_shortcode('[instagram-feed]'); ?>
	</div>


</div>
