<?php
if ( ! function_exists( 'add_action' )) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

// Setup Form
$form = tr_form()->useJson()->setGroup( $this->getName() );
?>

<h1>Theme Options</h1>
<div class="typerocket-container">
	<?php
	echo $form->open();

	// Information sur les réseaux sociaux
	$social = function() use ($form) {
		echo $form->text('facebook')->setLabel('Lien de la page facebook');
		echo $form->text('instagram')->setLabel('Lien du compte instagram');
	};


	$custom = function () use ($form){
	    echo $form->color('bgcolor')->setLabel('Couleur de fond d\'écran');
	    echo $form->image('bgimg')->setLabel('Image de fond d\'écran');
    };

	$issuu = function () use ($form){
		echo $form->text('issuu_link')->setLabel('Lien vers votre page')->setHelp('Lien vers votre page comportant l\'ensemble des publications Pause café');
	};

	// Save
	$save = $form->submit( 'Save' );

	// Layout
	tr_tabs()->setSidebar( $save )
	         ->addTab( 'Reseaux sociaux', $social )
	         ->addTab( 'Personnalisation Background', $custom )
	         ->addTab( 'Page Pause Café', $issuu )
	         ->render( 'box' );
	echo $form->close();
	?>

</div>