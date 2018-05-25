<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post();  SetPostViews(get_the_ID()); ?>
    <div class="uk-background-default uk-padding-small">
        <div class="uk-panel uk-padding uk-heading-categorie">
            <div class="uk-grid-small" uk-grid>
                <div class="uk-width-1-4@m uk-width-1-3">
                    <a href="<?= get_category_link(get_the_category(get_the_ID())[0]->parent);?>" class="uk-link-reset uk-heading"><h2 class="uk-h4 uk-heading"><?= get_cat_name( get_the_category(get_the_ID())[0]->parent ) ?></h2></a>
                </div>
                <div class="uk-width-3-4@m uk-width-2-3 uk-flex uk-flex-middle">
                    <div class="uk-child-width-auto uk-grid-small" uk-grid>
                        <?php
                        $catlist_exclus = get_categories(
                            array(
                                'child_of' => get_the_category(get_the_ID())[0]->parent,
                                'orderby' => 'id',
                                'order' => 'ASC',
                                'hide_empty' => '1'
                            ) );
                        ?>
                        <?php foreach ($catlist_exclus as $exclus): ?>
                            <div>
                                <div class="uk-grid-collapse <?php if($exclus->term_id === get_the_category(get_the_ID())[0]->term_id): ?>uk-background-secondary uk-active <?php endif ?> uk-padding-small uk-padding-remove-vertical uk-padding-remove-right" uk-grid>
                                    <div class="uk-width-5-6 uk-text-truncate">
                                        <a href="<?= get_category_link($exclus->term_id);?>" class="uk-link-reset"><?= $exclus->name; ?></a>
                                    </div>
                                    <div class="uk-width-1-6">
                                        <div class="uk-article-titre-categorie" style="background: <?=  tr_taxonomies_field('couleur_cat', 'category', $exclus->term_id); ?>;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="uk-card uk-card-default uk-grid-collapse uk-margin uk-card-small uk-flex" uk-grid>

            <div class="uk-width-3-5@m uk-width-1-1@s">
                <div class="uk-card-body uk-border-top">
                    <h1 class="uk-h2 uk-text-uppercase uk-article-titre uk-text-break"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
                    <div class="uk-article-description uk-article-description-italic">
                        <?php the_excerpt() ?>
                    </div>
                    <div class="uk-article-meta uk-h6 uk-margin-remove uk-article-date">
                        Le <?= get_the_date('d/m/Y', get_the_ID()) ?> <br>
                    </div>
                    <div class="uk-grid-small uk-child-width-auto uk-h6 uk-text-uppercase uk-article-date uk-grid uk-grid-stack" uk-grid="">
                        <div class="uk-first-column">
	                        <?php $auteur_id = get_the_author_ID(); ?>
                            par : <a class="uk-link-reset" href="#"><?php the_author_meta( 'display_name' , $auteur_id ); ?></a>
                        </div>
                    </div>


                    <div class="uk-margin uk-child-width-expand uk-grid-collapse uk-button-shared uk-article-eco" uk-grid>
                        <div class="uk-bg-default">
                            <a href="#modal-center" uk-toggle class="uk-button uk-button-secondary uk-button-small uk-button-article uk-width-1-1">Abonnez-vous</a>
                        </div>
                        <div class="uk-bg-none st-custom-button" data-network="facebook" data-image="<?= get_the_post_thumbnail_url() ?>">
                            <a href="#" class="uk-button uk-button-small uk-button-article uk-width-1-1" onclick="event.preventDefault();"><span uk-icon="icon: facebook" class="uk-icon"></span> Partager</a>
                        </div>
                        <div class="uk-bg-none st-custom-button" data-network="twitter" data-image="<?= get_the_post_thumbnail_url() ?>">
                            <a href="#" class="uk-button uk-button-small uk-button-article uk-width-1-1" onclick="event.preventDefault();"><span uk-icon="icon: twitter" class="uk-icon"></span> twitter</a>
                        </div>
                        <div class="uk-bg-default-inverse">
                            <a href="#comments" class="uk-button uk-button-small uk-button-article uk-button-default uk-width-1-1" uk-scroll> <span class="fa fa-comment uk-icon"></span> Réagir </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-card-media-right uk-cover-container uk-width-2-5@m uk-width-1-1@s uk-flex-first@s">
	            <?=  get_the_post_thumbnail(get_the_ID(), 'full', array('uk-cover'=> ''));?>
                <canvas width="600" height="400"></canvas>
            </div>
            <div class="uk-width-3-5@m uk-width-1-1@s uk-margin">
                <div class="uk-card-body uk-card-content">
	                <?php the_content() ?>
                    <div class="uk-margin-large uk-child-width-expand uk-grid-collapse uk-button-shared" uk-grid>
                        <div class="uk-bg-default">
                            <a href="#modal-center" uk-toggle class="uk-button uk-button-secondary uk-button-small uk-button-article uk-width-1-1">Abonnez-vous</a>
                        </div>
                        <div class="uk-bg-none st-custom-button" data-network="facebook" data-image="<?= get_the_post_thumbnail_url() ?>">
                            <a href="#" class="uk-button uk-button-small uk-button-article uk-width-1-1" onclick="event.preventDefault();"><span uk-icon="icon: facebook" class="uk-icon"></span> Partager</a>
                        </div>
                        <div class="uk-bg-none st-custom-button" data-network="twitter" data-image="<?= get_the_post_thumbnail_url() ?>">
                            <a href="#" class="uk-button uk-button-small uk-button-article uk-width-1-1" onclick="event.preventDefault();"><span uk-icon="icon: twitter" class="uk-icon"></span> twitter</a>
                        </div>
                        <div class="uk-bg-default-inverse">
                            <a href="#comments" class="uk-button uk-button-small uk-button-article uk-button-default uk-width-1-1" uk-scroll> <span class="fa fa-comment uk-icon"></span> Réagir </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-card-media-right uk-width-2-5@m uk-width-1-1@s uk-margin">
                <?php
                    $galleries = tr_posts_field('image_de_la_gallerie');
                    if($galleries):

                ?>
                <div class="uk-position-relative uk-visible-toggle uk-light" uk-slideshow="animation: fade; autoplay: true; min-height: 300; max-height: 800; autoplay-interval: 3000">

                    <ul class="uk-slideshow-items">
                        <?php

	                        foreach ($galleries as $gallerie):



                        ?>
                            <li class="">
                                <img src="<?php echo wp_get_attachment_image_url($gallerie['image']);?>" alt="" uk-cover>

                                <div class="uk-overlay uk-overlay-primary uk-position-bottom uk-text-center uk-transition-slide-bottom">
                                    <p class="uk-margin-remove uk-text-small">
                                        <?=
                                            $gallerie['contenu']
                                        ?>
                                    </p>
                                </div>
                            </li>
                        <?php
	                        endforeach;
                        ?>
                    </ul>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                </div>
                <?php
                    endif;
                ?>
                <div class="uk-margin uk-pub">

	                <?php
	                    if( function_exists('the_ad_placement') ) { the_ad_placement('article-pub'); }
	                ?>
                </div>
            </div>
        </div>

        <div class="uk-grid-small" uk-grid>
            <div class="uk-width-2-3@m uk-width-1-1@s">
	            <?php
	            $args = array(

		            'post_type' => 'post',
		            'post_status' => 'publish',
		            'posts_per_page' => '4',
		            'post__not_in' => [get_the_ID()],
		            'paged' => 1,
		            'cat' => get_the_category(get_the_ID())[0]->term_id

	            );
	            wp_reset_query();

	            $similraire = new WP_Query( $args );

                if($similraire->have_posts()):

	            ?>
                <div class="uk-card uk-card-default uk-card-small uk-recent">
                    <div class="uk-card-header">
                        <h3 class="uk-card-title">Sur le même sujet</h3>
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-grid-small uk-child-width-1-2@m uk-child-width-1-1@s uk-margin" uk-grid>
	                        <?php while ( $similraire->have_posts() ) : $similraire->the_post(); ?>
                            <div class="the_post">

                                <div class="uk-card uk-card-default uk-card-small uk-card-article">
                                    <div class="uk-card-media-top">
	                                    <?=  get_the_post_thumbnail( $similraire->ID, 'full');?>
                                    </div>
                                    <div class="uk-card-body">
                                        <div class="uk-article-meta uk-categorie"><a href="<?= get_category_link(get_the_category($similraire->ID)[0]->term_id);?>" class="uk-text-uppercase uk-text-bold uk-animation-shake" style="color: <?=  tr_taxonomies_field('couleur_cat', 'category', get_the_category($similraire->ID)[0]->term_id); ?>;"><?= get_the_category($similraire->ID)[0]->name; ?></a></div>
                                        <h2 class="uk-article-titre uk-text-uppercase uk-h5 uk-text-truncate uk-margin-remove"><a href="<?php the_permalink($similraire->ID) ?>"><?php the_title() ?></a> </h2>
                                        <div class="uk-article-meta uk-categorie"><?= get_the_date('d/m/Y', $similraire->ID) ?></div>

                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>

                        </div>

                        <div class="uk-width-1-1 uk-flex uk-flex-center uk-padding-small uk-padding-remove-vertical uk-margin-small uk-article-button uk-animation-toggle">
                            <a href="" class="uk-button uk-button-secondary uk-animation-shake loadmore">+ "d'article"</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="uk-margin uk-pub">
	                <?php
	                    if( function_exists('the_ad_placement') ) { the_ad_placement('home-middle'); }
	                ?>
                </div>

                <div class="uk-margin uk-comments" id="comments">
                    <div class="uk-card uk-card-small">
                        <div class="uk-card-header uk-position-relative">
                            <h3 class="uk-card-title uk-heading-divider">Commentaires

                            <button uk-toggle="target: #formulaire; animation: uk-animation-fade" type="button" class="uk-button uk-button-default uk-button-menu uk-float-right uk-visible@m">Reagir</button>
                            </h3>
                            <button uk-toggle="target: #formulaire; animation: uk-animation-fade" type="button" class="uk-button uk-button-default uk-button-menu uk-hidden@m uk-width-1-1@s">Reagir</button>

                        </div>
                        <div id="formulaire" hidden class="uk-padding-small">
		                    <?php
		                    $comment_args = array(
			                    'fields' => apply_filters(
				                    'comment_form_default_fields',
				                    array(
					                    'author' => '<div class="uk-margin"><label for="author" class="uk-form-label">Quel est votre nom ? *</label>
                                                        <input id="author" class="uk-input" name="author" type="text" value="" placeholder="Nom"></div>',

					                    'email'  => '<div class="uk-margin"><label for="email" class="uk-form-label">Quel est votre email ? *</label><br>
                                                <input id="email" class="uk-input" name="email" type="text" value="" placeholder="Email"></div>',

					                    'url'    => ''
				                    )
			                    ),

			                    'comment_field' => '<div class="uk-margin"><label for="comment" class="uk-form-label">Que souhaitez-vous dire ?</label><br>
                                        <textarea id="comment" class="uk-textarea" name="comment" placeholder="Commentaire" rows="10"></textarea></div>',

			                    'comment_notes_after' => '',
			                    'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s uk-button uk-button-secondary" style="color: #ffffff" value="%4$s"/>'

		                    );

		                    comment_form($comment_args);

		                    ?>
                            <hr>
                        </div>

                        <div class="uk-card-body">
	                        <?php

                                $args_comment = array(
                                    'post_id' => get_the_ID(),
                                    'order' => 'DESC',
                                    'hierarchical' => 'threaded',
                                    'number' => 3,
                                    'offset'=> 0,

                                    'status' => 'approve'
                                );
                                $commentsArray = get_comments($args_comment);
                                //            var_dump($commentsArray);
                                if($commentsArray) :

                            ?>
                                <?php foreach ($commentsArray as $e) : ?>
                                <article class="uk-comment uk-margin the_post_comment">
                                    <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
                                        <div class="uk-width-expand uk-first-column">
                                            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                                <li>Le <?= date_i18n(get_option('date_format'), strtotime($e->comment_date)) ?></li>
                                            </ul>
                                        </div>
                                        <div class="uk-width-1-1 uk-margin-small uk-text-bold"><?= $e->comment_author ?></div>
                                    </header>
                                    <div class="uk-comment-body">
                                        <p>
                                            <?= $e->comment_content; ?>
                                        </p>
                                    </div>
                                        <?php
                                            $args_comment_child = array(
                                                'order' => 'DESC',
                                                'parent' => $e->comment_ID,
                                                'status' => 'approve'
                                            );
                                            $commentsArray_child = get_comments($args_comment_child);

                                            foreach ($commentsArray_child as $e_child):
		                                ?>
                                            <hr>
                                            <article class="uk-comment uk-margin uk-margin-medium-left" style="border: none">
                                                <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
                                                    <div class="uk-width-expand uk-first-column">
                                                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                                            <li>Le <?= date_i18n(get_option('date_format'), strtotime($e_child->comment_date)) ?></li>
                                                        </ul>
                                                    </div>
                                                    <div class="uk-width-1-1 uk-margin-small uk-text-bold"><?= $e_child->comment_author ?></div>
                                                </header>
                                                <div class="uk-comment-body">
                                                    <p>
                                                        <?= $e_child->comment_content; ?>
                                                    </p>
                                                </div>
                                            </article>
                                        <?php endforeach; ?>
                                </article>

                                <?php endforeach; ?>
                                <div class="uk-width-1-1 uk-flex uk-flex-center uk-padding-small uk-padding-remove-vertical uk-margin-small uk-article-button uk-animation-toggle">
                                    <a href="" class="uk-button uk-button-secondary loadmoreComment">charger plus</a>
                                </div>
                            <?php else: ?>
                                    <div class="uk-heading-primary uk-text-center uk-margin-medium-top">Aucun commentaire</div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>



            </div>
            <div class="uk-width-1-3@m uk-width-1-1@s">
	            <?php get_template_part( 'pubAndSocial' ); ?>
	            <?php get_template_part( 'populaireWidget' ); ?>
            </div>
        </div>

        <div class="uk-margin">
	        <?php
	            if( function_exists('the_ad_placement') ) { the_ad_placement('home-footer'); }
	        ?>
        </div>
    </div>

    <script>
        var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";

        var paged = 2;
        jQuery(function($) {
            $('body').on('click', '.loadmore', function(e) {
                e.preventDefault();
                var data = {
                    'action': 'load_posts_by_ajax',
                    'page': paged,
                    'security': '<?php echo wp_create_nonce("load_more_posts"); ?>',
                    'cat' : '<?php echo get_the_category(get_the_ID())[0]->term_id; ?>',
                    'type' : 'single',
                    'current_post' : '<?php echo get_the_ID(); ?>'
                };

                $.post(ajaxurl, data, function(response) {
                    if(response === ''){
                        $('body .loadmore').removeClass('uk-button-secondary').addClass('uk-animation-shake uk-button-default').prop('disabled', true);
                    }else{
                        $('.the_post:last').after(response);
                        paged++;
                    }
                });
            });
        });

        var page = 3;
        jQuery(function($) {
            $('body').on('click', '.loadmoreComment', function(e) {
                e.preventDefault();
                var data = {
                    'action': 'load_posts_by_ajax',
                    'security': '<?php echo wp_create_nonce("load_more_posts"); ?>',
                    'page': page,
                    'type' : 'comment',
                    'current_post': '<?= get_the_ID(); ?>'
                };

                $.post(ajaxurl, data, function(response) {
                    if(response === ''){
                        $('body .loadmoreComment').removeClass('uk-button-secondary').addClass('uk-animation-shake uk-button-default').prop('disabled', true);
                    }else{
                        $('.the_post_comment:last').after(response);
                        page = page + 3;
                    }
                });
            });
        });


        (function(document) {
            var shareButtons = document.querySelectorAll(".st-custom-button[data-network]");
            for(var i = 0; i < shareButtons.length; i++) {
                var shareButton = shareButtons[i];

                shareButton.addEventListener("click", function(e) {
                    var elm = e.target;
                    var network = elm.dataset.network;

//                    console.log("share click: " + network);
                });
            }
        })(document);
    </script>
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=59d7323924e793001110e213&product=custom-share-buttons"></script>


<?php endwhile;  ?>
<?php get_footer(); ?>