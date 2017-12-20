<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 15/12/2017
 * Time: 11:57
 */

use Abraham\TwitterOAuth\TwitterOAuth;

if(is_numeric($data['nbre_tweet'])):
	$numTweets      = $data['nbre_tweet'];                // Number of tweets to display.
else:
	$numTweets      = 3;
endif;

$name           = $data['screen_name'];  // Username to display tweets from.
$excludeReplies = false;             // Leave out @replies
$transName      = 'list-tweets';    // Name of value in database.
$cacheTime      = 5;

$backupName = $transName . '-backup';

if(false === ($tweets = get_transient($transName) ) && $name) :

	$connection = new TwitterOAuth(
		$data['consumerkey'],   // Consumer key
		$data['consumersecret'],   // Consumer secret
		$data['accestoken'],   // Access token
		$data['accestokensecret']    // Access token secret
	);

	// If excluding replies, we need to fetch more than requested as the
	// total is fetched first, and then replies removed.
	$totalToFetch = ($excludeReplies) ? max(50, $numTweets * 3) : $numTweets;

	$fetchedTweets = $connection->get(
		'statuses/user_timeline',
		array(
			'screen_name'     => $name,
			'count'           => $totalToFetch,
			'exclude_replies' => $excludeReplies
		)
	);

	// Did the fetch fail?
	if($connection->getLastHttpCode() != 200) :
		$tweets = get_option($backupName); // False if there has never been data saved.
	else :
		// Fetch succeeded.
		// Now update the array to store just what we need.
		// (Done here instead of PHP doing this for every page load)
		$limitToDisplay = min($numTweets, count($fetchedTweets));

		for($i = 0; $i < $limitToDisplay; $i++) :
			$tweet = $fetchedTweets[$i];

			// Core info.
			$name = $tweet->user->name;
			$permalink = 'http://twitter.com/'. $name .'/status/'. $tweet->id_str;
			/* Alternative image sizes method: http://dev.twitter.com/doc/get/users/profile_image/:screen_name */
			$image = $tweet->user->profile_image_url;
			// Message. Convert links to real links.
			$pattern = '/http:(\S)+/';
			$replace = '<a href="${0}" target="_blank" rel="nofollow">${0}</a>';
			$text = preg_replace($pattern, $replace, $tweet->text);
			// Need to get time in Unix format.
			$time = $tweet->created_at;
			$time = date_parse($time);
			$uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);
			// Now make the new array.
			$tweets[] = array(
				'text' => $text,
				'name' => $name,
				'permalink' => $permalink,
				'image' => $image,
				'time' => $uTime
			);
		endfor;
		// Save our new transient, and update the backup.
		set_transient($transName, $tweets, 60 * $cacheTime);
		update_option($backupName, $tweets);
	endif;
endif;
?>


<div id="<?= $data['idblocktweeter']; ?>" class="uk-section uk-tweeter" style="background-color: <?= $data['bgcolor_tweet']; ?>">
	<div class="uk-container uk-container-small">
		<div uk-slideshow="animation: slide; max-height: 300; autoplay: true">

			<div class="uk-position-relative uk-visible-toggle uk-light">

				<ul class="uk-slideshow-items">
					<?php foreach ($tweets as $tweet): ?>
						<li>
							<div class="uk-grid-small" uk-grid>
								<div class=" uk-width-1-1 uk-flex uk-flex-center">
									<span class="uk-ico uk-display-block fa fa-twitter" style="color: <?= $data['color_icone']; ?> !important;"></span>
								</div>
								<div class="uk-description uk-width-1-1 uk-margin uk-flex-center uk-flex">
									<div class="uk-width-3-5 uk-text-center uk-text-lowercase uk-text-large" style="color: <?= $data['color_text']; ?> !important;">
										<?= $tweet['text'] ?>
									</div>
								</div>
								<div class="uk-width-1-1 uk-flex-center uk-flex uk-margin-remove">
									<div class="uk-width-1-4 uk-hr"></div>

								</div>
								<div class="uk-margin uk-width-1-1 uk-text-center uk-title" style="color: <?= $data['color_user']; ?> !important;">
									<?= $tweet['name'] ?>
								</div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<ul class="uk-dotnav uk-flex-center uk-margin-small">
				<?php $i = 0; ?>
				<?php foreach ($tweets as $tweet): ?>
					<li uk-slideshow-item="<?= $i ?>"><a href="#">Item <?= $i ?></a></li>
				<?php $i++; endforeach; ?>
			</ul>

		</div>

	</div>
</div>