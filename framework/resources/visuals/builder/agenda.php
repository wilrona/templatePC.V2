<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 12/12/2017
 * Time: 17:12
 */

?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/tooltip.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/timelinz.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">


<div id="<?= $data['idblockagenda'] ?>" class="uk-section" style="background-image: url('<?php echo wp_get_attachment_image_url($data['imgfondagenda'], 'full') ?>'); background-repeat: no-repeat; background-size:cover; background-color: <?= $data['colorfondagenda'] ?>;">
	<div class="uk-container">
		<?php if($data['titreagenda']): ?>
		<h1 class="page-header"><?= $data['titreagenda'] ?></h1>
		<?php endif; ?>
		<div id="main" class="uk-margin" uk-grid>
			<div class="uk-width-1-2@m uk-width-1-1@s">
				<h2 id="point-title" class="inline-block underline"></h2>
				<p id="point-desc"></p>

				<h2 id="speakers-title" class="inline-block underline hidden">Intervenants</h2>
				<div id="speakers"></div>
			</div>
			<div id="timeline" class="uk-width-1-2@m uk-width-1-1@s"></div>
		</div>
	</div>
</div>


<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/timelinz.js"></script>
<script>
    jQuery(function () {
        var genrateDate = function (time) {
            var toInt = function (i) {
                return +i;
            };
            var date = (new Date()).toJSON().substr(0, 10).split('-').map(toInt);
            time = time.split(':').map(toInt);
            return new Date(date[0], date[1] - 1, date[2], time[0], time[1], time[2]);
        };

        var data = [
            <?php  foreach ($data['event'] as $event): ?>
            {
                name: '<?= $event['titleagenda']; ?>',
	            <?php
	                $query = new WP_Query( array( 'post_type' => 'agenda', 'p' => $event['eventagenda']) );
	            ?>
                points: [
                    <?php if($query->have_posts()): ?>
		                <?php while ( $query->have_posts() ) : $query->the_post(); global $post?>
							<?php foreach (tr_posts_field('event', $post->ID) as $dataevent): ?>

			                    {
			                        filled: true,
			                        img: '<?php echo wp_get_attachment_image_url($dataevent['imgspeaker'], 'full') ?>',
			                        time: genrateDate('<?= $dataevent['heuredebut']; ?>:00'),
			                        speaker: {
			                            name: '<?= $dataevent['nomspeaker'] ?>',
			                            img: '<?php echo wp_get_attachment_image_url( $dataevent['imgspeaker'], 'full') ?>',
			                            job: '<?= $dataevent['fonctionspeaker']; ?>',
			                        },
			                        desc: '<?= str_replace('\'', '\\\'', $dataevent['descriptionsujet']); ?>'
			                    },
			                    {
			                        filled: false,
			                        time: genrateDate('<?= $dataevent['heurefin']; ?>:00'),
			                        speaker: {
			                            name: '<?= $dataevent['nomspeaker'] ?>',
			                            img: '<?php echo wp_get_attachment_image_url( $dataevent['imgspeaker'], 'full') ?>',
			                            job: '<?= $dataevent['fonctionspeaker']; ?>',
			                        },
			                        desc: '<?= str_replace('\'', '\\\'', $dataevent['descriptionsujet']); ?>'
			                    },
	                        <?php endforeach; ?>
		                <?php endwhile; ?>
	                <?php endif; ?>
                ]
            },
	        <?php endforeach; ?>
        ];
        var speakerTmpl =
            '<a href="javascript:void(0)" class="speaker">' +
            '<img src="{img}" alt="">' +
            '<div class="speaker-inner">' +
            '<h3 class="speaker-name">{name}</h3>' +
            '<span class="speaker-job">{job}</span>' +
            '</div>' +
            '</a>';

        var pad = function (num, count) {
            return ((new Array(count + 1)).join('0') + num).slice(count * -1);
        };

        var dateFormat = function (date) {
            return pad(date.getHours(), 2) + ':' + pad(date.getMinutes(), 2);
        };

        var selectPoint = function (pointData, timelineData) {
            // Set point title
            var $pointTitleElem = jQuery('#point-title');
            var title = '';
            if (pointData.title) {
                title += pointData.title + ' at ';
            }
            title += dateFormat(new Date(pointData.time)) + ' - ' + timelineData.name;
            $pointTitleElem.text(title);

            // Set point description
            jQuery('#point-desc').html(pointData.desc);

            // Set speakers
            var $speakersTitleElem = jQuery('#speakers-title');
            var $speakersElem = jQuery('#speakers');
            $speakersElem.empty();
            if (pointData.speaker) {
                $speakersTitleElem.removeClass('hidden');

                var template = speakerTmpl.replace('{img}', pointData.speaker.img)
                    .replace('{name}', pointData.speaker.name)
                    .replace('{job}', pointData.speaker.job);
                $speakersElem.append(template);
            } else {
                $speakersTitleElem.addClass('hidden');
            }
        };

        var $timelinzElem = jQuery('#timeline')[0];
        var timelinz = new Timelinz(data, {
            intervalUnit: 'hour',
            extraIntervals: [0, 0],
            marginBetweenLines: 70,
            intervalFormat: dateFormat,

            onLineRendered: function (lineElem, lineData) {
                // Add timeline title
                var template = '<h4 class="timelinz__line-title">{name}</h4>'.replace('{name}', lineData.name);
                jQuery(lineElem).prepend(template);
            },

            onPointRendered: function (pointElem, pointData, timelineData) {
                var $pointElem = jQuery(pointElem);
                // Set tooltip
                var tooltip = dateFormat(new Date(pointData.time));
                if (pointData.title) {
                    tooltip += ' - ' + pointData.title;
                } else {
                    tooltip += pointData.speaker ? ' - ' + pointData.speaker.name : '';
                }
                $pointElem.addClass('tooltip-left')
                    .attr('data-tooltip', tooltip);

                // Append <span> to normal points
                if (!pointData.img) {
                    $pointElem.append(document.createElement('span'));
                }
            },

            onPointClicked: function (e, pointData, timelineData) {
                e.preventDefault();
                selectPoint(pointData, timelineData);
            },

            onRenderCompleted: function () {
                // Choose default point
                selectPoint(data[0].points[0], data[0]);
            }
        });
        timelinz.render($timelinzElem);
    });

</script>
