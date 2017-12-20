<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 12/12/2017
 * Time: 16:36
 */
?>
<h1>Contenu avec Slider</h1>
<?php
echo $form->text('idblockcontenu')->setLabel('ID du block')->setHelp('ID va permettre de faire des scroll direct vers la zone ou il se trouve si il a été définit lors de la création des rubriques');
echo $form->text('titrecontenu')->setLabel('Titre du block');
echo $form->editor('textcontenu')->setLabel('Contenu du block');
echo $form->color('bgcolor')->setLabel('Couleur de fond du block');
echo $form->color('colortitle')->setLabel('Couleur du titre');
echo $form->color('colortexte')->setLabel('Couleur de texte');
echo $form->text('textbutton')->setLabel('Texte du bouton');
echo $form->text('linkbutton')->setLabel('Lien du bouton');
echo $form->color('colortextebuttom')->setLabel('Couleur de texte du bouton');
echo $form->color('colorborderbuttom')->setLabel('Couleur de la bordure du bouton');
echo $form->repeater('slidercontenu')->setFields([

	$form->image('slidercontent')->setLabel('Image du slider')

])->setLabel('Ajouter des images à votre block');