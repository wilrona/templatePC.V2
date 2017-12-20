<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 12/12/2017
 * Time: 15:22
 */
?>
	<h1>Contenu des prix</h1>
<?php
echo $form->text('idblockprice')->setLabel('ID du block')->setHelp('ID va permettre de faire des scroll direct vers la zone ou il se trouve si il a été définit lors de la création des rubriques');

echo $form->editor('contenuprice')->setLabel('Contenu');
echo $form->color('colortextprice')->setLabel('Couleur du texte');

echo $form->image('imgleftprice')->setLabel('Image 1 en position gauche');
echo $form->image('imgrightprice')->setLabel('Image 2 en position droite');


echo $form->image('pricefond')->setLabel('Image de fond')->setHelp('Changer l\'image de fond du block');
echo $form->color('pricefondcolor')->setLabel('Couleur de fond')->setHelp('Le changement ne s\'effectue quand l\'image de fond n\'a pas été défini');


echo $form->text('linktext')->setLabel('Texte du bouton');
echo $form->color('colortextlink')->setLabel('Couleur du texte du  bouton');
echo $form->color('bordertextlink')->setLabel('Couleur de la bordure du bouton');



