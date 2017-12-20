<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 12/12/2017
 * Time: 17:13
 */
?>
	<h1>Affichage de l'agenda</h1>
<?php
echo $form->text('idblockagenda')->setLabel('ID du block')->setHelp('ID va permettre de faire des scroll direct vers la zone ou il se trouve si il a été définit lors de la création des rubriques');
echo $form->image('imgfondagenda')->setLabel('Image de fond');
echo $form->color('colorfondagenda')->setLabel('Couleur de fond');
echo $form->text('titreagenda')->setLabel('Titre Agenda');
$repeater = $form->repeater('event')->setFields([

	$form->text('titleAgenda')->setLabel('Nom de la journée'),
	$form->search('eventAgenda')->setLabel('Selectionnez un agenda')->setPostType('agenda')

])->setLabel('Ajouter des journées dans votre agenda');
echo $repeater;
