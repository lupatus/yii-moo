<?php

return array(
	
	'jquery-noconflict' => array(
		'js' => array('jquery-noconflict.js'),
		'depends' => array('jquery'),
		'basePath' => 'ext.moo.assets',
	),
	
	'moo' => array(
		'js' => array(YII_DEBUG ? 'mootools-core-1.4.5.js' : 'mootools-core-1.4.5-min.js'),
		'basePath' => 'ext.moo.assets',
	),
	
	'moo-more' => array(
		'depends' => array('moo'),
		'js' => array(YII_DEBUG ? 'mootools-more-1.4.0.1.js' : 'mootools-more-1.4.5-min.js'),
		'basePath' => 'ext.moo.assets',
	)
	
);