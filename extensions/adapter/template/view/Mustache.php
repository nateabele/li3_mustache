<?php

namespace li3_mustache\extensions\adapter\template\view;

use Mustache as Renderer;
use lithium\core\Libraries;

class Mustache extends \lithium\template\view\adapter\File {

	public function render($template, $data = array(), array $options = array()) {
		$this->_context = $options['context'] + $this->_context;
		$this->_data = (array) $data + $this->_vars;
		$renderer = new Renderer();
		return $renderer->render(file_get_contents($template), $this->_context + $this->_data);
	}

	/**
	 * Returns a template file name
	 *
	 * @param string $type
	 * @param array $params
	 * @return string
	 */
	public function template($type, array $params) {
		$params += array('library' => true);
		$params['library'] = Libraries::get($params['library'], 'path');
		return $this->_paths($type, $params);
	}
}

?>