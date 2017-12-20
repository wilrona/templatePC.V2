<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 06/12/2017
 * Time: 09:28
 */



$mag = tr_post_type('Magazine', 'Magazines');

$mag->setIcon('books');

$mag->setArgument('supports', ['title'] );


$box = tr_meta_box('Information Magazine');

$box->addPostType( $mag->getId() );


$box->setCallback(function (){
	$form = tr_form();
	echo $form->text('url')->setLabel('Lien du magazine en ligne');
	echo $form->image('img courte')->setLabel('Image Courte')->setHelp('Image sur la dimension 83px * 53 px');
	echo $form->image('img longue')->setLabel('Image Grand Format')->setHelp('Image sur la dimension 166px * 197 px');
});