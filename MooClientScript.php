<?php

class MooClientScript extends CClientScript {

	const POS_MOOLOAD  = 33;
	const POS_MOOREADY = 44;
	
	private $_noConflict = 1;
	
	public function reset() {
		$this->_noConflict = 1;
		parent::reset();
	}
	
	public function renderBodyEnd(&$output) {
		if (isset($this->scripts[self::POS_MOOREADY]) || isset($this->scripts[self::POS_MOOLOAD])) {
			$fullpage = preg_match('/(<\\/body\s*>)/is', $output);
			foreach (array('domready' => self::POS_MOOREADY, 'load' => self::POS_MOOLOAD) as $event => $pos) {
				if (isset($this->scripts[$pos])) {
					if ($fullpage) {
						$script = "(function() {\n\tvar e__{$event};\n\te__{$event} = function() {\n\t\twindow.removeEvent('{$event}',e__{$event});\n".implode("\n",$this->scripts[$pos])."\n\t};\n\twindow.addEvent('{$event}',e__{$event});\n}());";
					} else {
						$script = implode("\n",$this->scripts[$pos]);
					}
					$id = uniqid($event.'---moo---', true);
					$this->registerScript($id, $script, self::POS_END);
					unset($this->scripts[$pos]);
				}
			}
		}
		parent::renderBodyEnd($output);
	}
	
	public function registerMooScript($id,$script,$position=self::POS_MOOREADY) {
		return $this->registerScript($id,$script,$position);
	}
	
	public function registerScript($id,$script,$position=self::POS_READY) {
		if ($position == self::POS_MOOREADY || $position == self::POS_MOOLOAD) {
			$this->registerCoreScript('moo');
		}
		return parent::registerScript($id, $script, $position);
	}
	
	public function registerCoreScript($name) {
		if ($this->corePackages === null) {
			$this->corePackages = array_merge(
				require(YII_PATH.'/web/js/packages.php'),
				require(Yii::getPathOfAlias('ext.yii-moo.packages').'.php')
			);
		}
		if (($this->_noConflict & 1)) {
			$add = false;
			switch ($name) {
				case 'jquery' :
					$this->_noConflict |= 2;
					$add = $this->_noConflict & 4;
					break;
				case 'moo' :
					$this->_noConflict |= 4;
					$add = $this->_noConflict & 2;
					break;
			}
			if ($add) {
				$this->_noConflict ^= ~1;
				parent::registerCoreScript('jquery-noconflict');
			}
		}
		return parent::registerCoreScript($name);
	}

}