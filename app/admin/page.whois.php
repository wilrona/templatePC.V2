<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 07/12/2017
 * Time: 16:33
 */


$box = tr_meta_box('Block')->setLabel('Block d\'information');
$box->addScreen('page'); // updated
$box->setCallback(function(){
	$form = tr_form();

	$repeater = $form->repeater('blocks')->setFields([
		$form->text('titre')->setLabel('Titre du block'),
		$form->editor('contenu')->setLabel('Contenu du block')


	])->setLabel('Ajouter les blocks sur votre page');

	echo $repeater;

});

add_action('admin_head', function () use ($box){
	if(get_page_template_slug(get_the_ID()) === 'pageWhois.php'){

		remove_post_type_support('page', 'editor');

	}else{
		remove_meta_box( $box->getId(), 'page', 'normal');
	}
});
