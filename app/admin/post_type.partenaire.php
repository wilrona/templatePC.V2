<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 08/12/2017
 * Time: 08:38
 */


$mag = tr_post_type('Partenaire', 'Partenaires');

$mag->setIcon('user-tie');

$mag->setArgument('supports', ['title', 'thumbnail'] );
