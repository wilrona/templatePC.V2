<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 06/12/2017
 * Time: 14:49
 */

?>
<?php
$popularpost = new WP_Query( array(
	'posts_per_page' => 5,
	'meta_key' => 'post_views_count',
	'orderby' => 'meta_value_num',
	'order' => 'DESC',
	'post_type' => 'post',
) );
?>
<?php if($popularpost->have_posts()): ?>
<div class="uk-card uk-card-small uk-card-default uk-populaire">
	<div class="uk-card-header">
		<h3 class="uk-card-title">Les plus populaires</h3>
	</div>
	<div class="uk-card-body uk-padding-remove">
		<table class="uk-table uk-table-divider uk-table-small">
			<tbody>
				<?php while ( $popularpost->have_posts() ) : $popularpost->the_post(); ?>
					<tr>
						<td class="uk-card-title uk-text-truncate">
							<a href="<?= get_the_permalink($popularpost->ID) ?>" class="uk-link-reset"><?= get_the_title() ?></a>

						</td>
						<td class="uk-width-expand">
							<div class="uk-article-titre-categorie" style="background: <?= tr_taxonomies_field('couleur_cat', 'category', get_the_category($popularpost->ID)[0]->term_id) ?>;">

							</div>
						</td>
						<td class="uk-width-expand uk-date"><?= get_the_date('d/m/Y', $popularpost->ID) ?></td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</div>
<?php endif; ?>