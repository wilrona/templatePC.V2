<?php /* Template Name: Page accueil */ ?>


<?php get_header(); ?>
	<?php while ( have_posts() ) : the_post(); ?>

        <?php set_query_var( 'actuel_cover', tr_posts_field('actuellement_en_cover') ) ?>
        <?php set_query_var( 'actuel_une', tr_posts_field('actuellement_la_une') ) ?>
        <?php set_query_var( 'actuel_dossier', tr_posts_field('actuellement_sur_dossier') ) ?>



		<?php set_query_var( 'afficher', tr_posts_field('afficherevent') ) ?>
		<?php set_query_var( 'logoevent', tr_posts_field('logoevent') ) ?>
		<?php set_query_var( 'lieuevent', tr_posts_field('lieuevent') ) ?>
		<?php set_query_var( 'textbuttonevent', tr_posts_field('textbuttonevent') ) ?>
		<?php set_query_var( 'linkbuttonevent', tr_posts_field('linkbuttonevent') ) ?>


		<?php set_query_var( 'datedebutevent', tr_posts_field('datedebutevent') ) ?>
		<?php set_query_var( 'heuredebutevent', tr_posts_field('heuredebutevent') ) ?>
		<?php set_query_var( 'blockevent', tr_posts_field('blockevent') ) ?>




<!--        Style du block festival-->
		<?php set_query_var( 'bgcevent', tr_posts_field('bgcevent') ) ?>
		<?php set_query_var( 'bgievent', tr_posts_field('bgievent') ) ?>
		<?php set_query_var( 'couleurtexteevent', tr_posts_field('couleurtexteevent') ) ?>
		<?php set_query_var( 'couleurtexteeventbutton', tr_posts_field('couleurtexteeventbutton') ) ?>
		<?php set_query_var( 'couleurbordereventbutton', tr_posts_field('couleurbordereventbutton') ) ?>


        <?php get_template_part( 'articleHome' ); ?>

		<?php get_template_part( 'homeFestival' ); ?>


		<div class="uk-background-default uk-padding-small">
			<?php get_template_part( 'homeMiddle' ); ?>

			<div class="uk-margin uk-pub">
				<?php
					if( function_exists('the_ad_placement') ) { the_ad_placement('home-footer'); }
				?>
			</div>

			<div class="uk-margin">
				<?php get_template_part( 'homeDossier' ); ?>

			</div>

			<div class="uk-pc">
				<div class="uk-card">
					<div class="uk-card-header uk-padding-small">
						<h3 class="uk-card-title"><span>Lire plus de numero</span> <span class="uk-text-bold">en ligne</span></h3>
					</div>
					<div class="uk-card-body">
						<div class="uk-grid-small uk-child-width-1-2" uk-grid>
							<div>
								<div class="uk-grid-small uk-child-width-1-2" uk-grid>
                                    <?php
                                    $args = array(
                                        'post_type' => 'magazine',
                                        'posts_per_page' => 2,
                                    );

                                    $the_query_mag = new WP_Query( $args );

                                    if($the_query_mag->have_posts()):
                                        while ($the_query_mag->have_posts()): $the_query_mag->the_post();
                                            ?>
									<div>
                                        <a href="<?php tr_posts_field("url") ?>" target="_blank"><?php echo wp_get_attachment_image(tr_posts_field("img_longue"), 'full', false, array('class' => 'uk-img-pc')); ?></a>
									</div>
	                                        <?php
                                        endwhile;
                                    endif;
                                    ?>
								</div>
							</div>
							<div class="uk-flex uk-flex-middle">
								<div class="uk-margin-large-left">
									<a href="<?php tr_options_field('pc_options.issuu_link'); ?>" class="uk-button uk-button-text"><span>Lire plus de numero</span> <span class="uk-text-bold">en ligne</span></a>
									<a href="#modal-center" uk-toggle class="uk-button uk-button-default uk-button-menu uk-display-block uk-margin-small">Abonnez-vous</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>





	<?php endwhile; ?>
<?php get_footer(); ?>
