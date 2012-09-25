Mootools Extension for Yii
===========================

This extension adds Mootools JavaScript library into Yii framework, but does not remove jQuery support (only turns jQuery into noConflict mode if needed).

Installation
---------------------------
Put `yii-moo` directory into extensions directory in your project (usually it is `protected/extensions`) and edit configuration file (`protected/config/main.php`).

```php
/*...*/
	'components'=>array(
		'clientScript' => array(
			'class'=>'ext.yii-moo.MooClientScript',
		),
/*...*/
```

How to use
---------------------------

Register mootools library:
```php
	Yii::app()->clientScript->registerCoreScript('moo');
```

Register mootools-more library:
```php
	Yii::app()->clientScript->registerCoreScript('moo-more');
```

Registering script:
```php
	$id = 'my-id';
	$script = 'alert("hello world!")';
	Yii::app()->clientScript->registerMooScript($id,$script); 
	// or
	Yii::app()->clientScript->registerScript($id,$script, MooClientScript::POS_MOOREADY); 

	// for onload script
	Yii::app()->clientScript->registerScript($id,$script, MooClientScript::POS_MOOLOAD); 
```

