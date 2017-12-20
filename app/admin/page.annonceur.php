<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 07/12/2017
 * Time: 17:48
 */

$box = tr_meta_box('Form')->setLabel('Formulaire de contact');
$box->addScreen('page'); // updated
$box->setCallback(function(){
	$form = tr_form();

	$repeater = $form->text('contact')->setLabel('Lien vers le formulaire de contact');

	echo $repeater;

});

add_action('admin_head', function () use ($box){
	if(get_page_template_slug(get_the_ID()) !== 'pageAnnonceur.php'){
		remove_meta_box( $box->getId(), 'page', 'normal');
	}
});
