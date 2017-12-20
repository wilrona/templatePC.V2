<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 12/12/2017
 * Time: 15:01
 */
?>
<h1>Block de présentation</h1>
<?php

echo $form->text('idblockpresentation')->setLabel('ID du block')->setHelp('ID va permettre de faire des scroll direct vers la zone ou il se trouve si il a été définit lors de la création des rubriques');

echo $form->Editor('contentPresentation')->setLabel('Contenu');

echo $form->color('fondcolorpresentation')->setLabel('Couleur de fond');
echo $form->color('colortextpresentation')->setLabel('Couleur du texte');