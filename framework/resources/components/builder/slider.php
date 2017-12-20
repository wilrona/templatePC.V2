<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 12/12/2017
 * Time: 12:19
 */
?>
<h1>Slider des évènements</h1>
<?php
/** @var $form \TypeRocket\Elements\Form */
echo $form->text('idblockSlider')->setLabel('ID du block')->setHelp('ID va permettre de faire des scroll direct vers la zone ou il se trouve si il a été définit lors de la création des rubriques');

echo $form->repeater('slider')->setFields([

	$select = $form->select('Jour')->setOptions([

		'Choisir un jour' => '0',
		'1' => '01',
		'2' => '02',
		'3' => '03',
		'4' => '04',
		'5' => '05',
		'6' => '06',
		'7' => '07',
		'8' => '08',
		'9' => '09',
		'10' => '10',
		'11' => '11',
		'12' => '12',
		'13' => '13',
		'14' => '14',
		'15' => '15',
		'16' => '16',
		'17' => '17',
		'18' => '18',
		'19' => '19',
		'20' => '20',
		'21' => '21',
		'22' => '22',
		'23' => '23',
		'24' => '24',
		'25' => '25',
		'26' => '26',
		'27' => '27',
		'28' => '28',
		'29' => '29',
		'30' => '30',
		'31' => '31'
	])->setLabel('Date du jour de l\'evenement'),
	$select = $form->select('Mois')->setOptions([

		'Choisir un mois' => '0',
		'1' => 'jan',
		'2' => 'fev',
		'3' => 'mars',
		'4' => 'avr',
		'5' => 'mai',
		'6' => 'juin',
		'7' => 'juill',
		'8' => 'aout',
		'9' => 'sept',
		'10' => 'oct',
		'11' => 'nov',
		'12' => 'déc',
	])->setLabel('Mois du jour de l\'evenement'),
	$form->text('Annee')->setLabel('Année du jour de l\'evenement'),
	$form->editor('text')->setLabel('Texte ou titre'),

	$form->image('imageFond')->setLabel('Image de fond du slider'),

    $form->text('lienPass')->setLabel('Lien vers la page d\'achat de pass / inscription'),
    $form->text('messagePass')->setLabel('Message du bouton')

])->setLabel('Ajouter des rubriques à votre page');
