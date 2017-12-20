<?php

$home = (int) get_option('page_on_front');




$boxPages = tr_meta_box('Article de la cover');
$boxPages->addScreen('page'); // updated
$boxPages->setCallback(function(){
	$form = tr_form();

	echo $form->search('Actuellement en cover')->setPostType('post');
});

$boxUne = tr_meta_box('Article à la une');
$boxUne->addScreen('page'); // updated
$boxUne->setCallback(function(){
	$form = tr_form();

	$repeater = $form->repeater('Actuellement à la une')->setFields([
		$form->search('A la une')->setPostType('post')
	]);

	echo $repeater;

});

$boxDossier = tr_meta_box('Article en dossier');
$boxDossier->addScreen('page'); // updated
$boxDossier->setCallback(function(){
	$form = tr_form();

	$repeater = $form->repeater('Actuellement sur dossier')->setFields([
		$form->search('dossier')->setPostType('post')
	]);

	echo $repeater;

});


$boxFestival = tr_meta_box('Affichage Festival en cours');
$boxFestival->addScreen('page');
$boxFestival->setCallback(function(){
	$form = tr_form();

	$options = [
		'Oui' => 'yes',
		'Non' => 'no'
	];

	echo $form->select('afficherevent')->setOptions($options)->setLabel('Afficher sur la page d\'accueil')->setSetting('default', 'no');;
	echo $form->image('logoevent')->setLabel('Logo de l\'evenement');
	echo $form->date('datedebutevent')->setLabel('Date de début');
	echo $form->text('heuredebutevent')->setLabel('Heure de début')->setAttribute('placeholder', 'HH:MM');
//	echo $form->date('datefinevent')->setLabel('Date de fin');
//	echo $form->text('heurefinevent')->setLabel('Heure de fin')->setAttribute('placeholder', 'HH:MM');

	echo $form->editor('lieuevent')->setLabel('Information sur l\'evenement');
	echo $form->text('textbuttonevent')->setLabel('Texte du bouton');
	echo $form->text('linkbuttonevent')->setLabel('Lien du bouton');

	$repeater = $form->repeater('blockevent')->setFields([
		$form->text('titreMenublock')->setLabel('Nom du menu'),
		$form->image('imgageblock')->setLabel('image du block  '),
		$form->text('lienRubriqueblock')->setLabel('lien de vers la rubrique')

	])->setLabel('Ajouter des rubriques')->setHelp('Pensez à y mettre uniquement 3');
	echo $repeater;
});


$boxCustomFesti = tr_meta_box('Personnalisation de la zone d\'affichage du festival');
$boxCustomFesti->addScreen('page');
$boxCustomFesti->setCallback(function(){
	$form = tr_form();

	echo $form->color('bgcevent')->setLabel('Couleur de fond');
	echo $form->image('bgievent')->setLabel('Image de fond');
	echo $form->color('couleurtexteevent')->setLabel('Coueleur de texte');
	echo $form->color('couleurtexteeventbutton')->setLabel('Couleur de texte du bouton');
	echo $form->color('couleurbordereventbutton')->setLabel('Couleur de la bordure de texte du bouton');

});



add_action('admin_head', function () use ($home, $boxPages, $boxUne, $boxDossier, $boxFestival, $boxCustomFesti) {
	if($home == get_the_ID()){
		remove_post_type_support('page', 'editor');
	}else{

		remove_meta_box( $boxFestival->getId(), 'page', 'normal');
		remove_meta_box( $boxCustomFesti->getId(), 'page', 'normal');
		remove_meta_box( $boxPages->getId(), 'page', 'normal');
		remove_meta_box( $boxUne->getId(), 'page', 'normal');
		remove_meta_box( $boxDossier->getId(), 'page', 'normal');
	}
});











