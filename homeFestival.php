<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 13/12/2017
 * Time: 10:43
 */

 ?>
<?php if($afficher === "yes"): ?>
	<div class="uk-section uk-section-small uk-festival" style="background-image: url('<?php echo wp_get_attachment_image_url($bgievent, 'full') ?>'); background-size: cover; background-repeat: no-repeat; background-color:<?= $bgcevent ?>;">
		<div class="uk-grid-collapse" uk-grid uk-margin>
			<div class="uk-width-2-3@m uk-width-1-1@s uk-flex uk-flex-middle">
                    <span class="uk-logo uk-margin-medium-left">
                        <img src="<?php echo wp_get_attachment_image_url($logoevent, 'full') ?>" alt="" style="height: 100px;">
                    </span>
			</div>
			<div class="uk-width-1-3@m uk-width-1-1@s uk-countdown-custom">
                <?php $date = date_format(date_create($datedebutevent), 'Y-m-d'); ?>
				<span class="uk-text-uppercase uk-h3 uk-title-countdown" style="color: <?= $couleurtexteevent ?>; border-bottom-color: <?= $couleurtexteevent ?>;">CountDown</span>

				<div class="uk-grid-small uk-child-width-auto uk-countdown" uk-grid uk-countdown="date: <?= $date ?>T<?= $heuredebutevent ?>:00+00:00" style="color: <?= $couleurtexteevent ?>">
					<div>
						<div class="uk-countdown-number uk-countdown-days"></div>
						<div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s">Jours</div>
					</div>
					<div class="uk-countdown-separator">:</div>
					<div>
						<div class="uk-countdown-number uk-countdown-hours"></div>
						<div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s">Heures</div>
					</div>
					<div class="uk-countdown-separator">:</div>
					<div>
						<div class="uk-countdown-number uk-countdown-minutes"></div>
						<div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s">Minutes</div>
					</div>
					<div class="uk-countdown-separator">:</div>
					<div>
						<div class="uk-countdown-number uk-countdown-seconds"></div>
						<div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s">Secondes</div>
					</div>
				</div>

			</div>
		</div>

		<div class="uk-grid-small uk-child-width-1-3@m uk-child-width-1-1@s uk-padding-small" uk-grid>
            <?php $nbre = 1; ?>
            <?php foreach ($blockevent as $block): ?>
			<div>
				<div class="uk-inline-clip uk-transition-toggle uk-width-1-1">
					<img src="<?php echo wp_get_attachment_image_url($block['imgageblock'], 'full') ?>" alt="" class="uk-width-1-1">
					<div class="uk-overlay uk-overlay-primary uk-position-cover uk-flex-middle uk-flex uk-flex-center"><span class="uk-h3"><?= $block['titremenublock'] ?></span></div>
					<a href="<?= $block['lienrubriqueblock'] ?>" class="uk-display-block">
						<div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-primary uk-flex uk-flex-center uk-flex-middle">
							<span class="uk-transition-fade" uk-icon="icon: plus; ratio: 2"></span>
						</div>
					</a>
				</div>
			</div>
                <?php
                    if($nbre > 3):
                        break;
                    endif;

                    $nbre++;
                ?>
            <?php endforeach; ?>
		</div>

		<div class="uk-grid-small uk-padding-small" uk-grid>
			<div class="uk-width-2-3@m uk-width-1-1@s">
				<div class="uk-width-1-2@m uk-width-1-1@s uk-infos" style="color: <?= $couleurtexteevent ?>">
					<?= wpautop($lieuevent) ?>
				</div>

			</div>
            <?php if(!empty($linkbuttonevent) && !empty($textbuttonevent)): ?>
                <div class="uk-width-1-3@m uk-width-1-1@s uk-flex uk-flex-middle uk-flex-center@s">
                    <a href="<?= $linkbuttonevent ?>" class="uk-button uk-button-default uk-button-menu uk-display-block uk-width-1-1" style="color: <?= $couleurtexteeventbutton ?>; border-color: <?= $couleurbordereventbutton ?>;: "><?= $textbuttonevent ?></a>
                </div>
            <?php endif; ?>
		</div>
	</div>

<?php endif; ?>
