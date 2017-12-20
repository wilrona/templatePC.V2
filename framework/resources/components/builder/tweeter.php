<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 15/12/2017
 * Time: 11:57
 */
?>
<h1>Affichage les derniers tweets</h1>

<?php

echo $form->text('idblocktweeter')->setLabel('ID du block')->setHelp('ID va permettre de faire des scroll direct vers la zone ou il se trouve si il a été définit lors de la création des rubriques');


echo $form->text('consumerkey')->setLabel('Consumer Key (API Key)');
echo $form->text('consumersecret')->setLabel('Consumer Secret (API Secret)');
echo $form->text('accestoken')->setLabel('Access Token');
echo $form->text('accestokensecret')->setLabel('Access Token Secret');


echo $form->text('screen_name')->setLabel('Nom d\'utilisateur pour afficher les tweets');
echo $form->text('nbre_tweet')->setLabel('Nombre de tweet à afficher')->setAttributes(array('min' => 0))->setHelp('Veuillez introduire que des chiffres')->setType('number');

?>
<h3>Configuration du block</h3>
<hr>
<?php

echo  $form->color('bgcolor-tweet')->setLabel('Couleur de fond');
echo  $form->color('color-icone')->setLabel('Couleur de l\'icone');
echo  $form->color('color-text')->setLabel('Couleur du texte');
echo  $form->color('color-user')->setLabel('Couleur de l\'username');