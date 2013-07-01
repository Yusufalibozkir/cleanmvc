<?php
	
	class Boot {
		private $controller;
		
		public function __construct() {
			// call index page!
			if(!isset($_GET['url'])) {
				$index_controller = INDEX_CONTROLLER;
				require('controllers/'.$index_controller.'.php');
				$this->controller = new $index_controller();
				$this->controller->index();
				
				return true;
			}
			
			//get url
			$url = $_GET['url'];
			$url = explode('/', $url);
			
			$file = 'controllers/' . $url[0] . '.php';
			
			// reach controller
			if(file_exists($file)) {
				require($file);
			} else {
				$this->error();
				
				return false;
			}
			
			$this->controller = new $url[0]();
			
			//reach functions
			if (@method_exists($this->controller, $url[1]) and isset($url[2])) {
				$this->controller->$url[1]($url[2]);
			} elseif (@!method_exists($this->controller, $url[1]) and !empty($url[1])) {
				$this->error();
				
				return false;
			} elseif (!empty($url[1]) and empty($url[2])) {
				$this->controller->$url[1]();
			} elseif (empty($url[1])) {
				$this->controller->index();
			} else {
				$this->error();
				
				return false;
			}
		}
		
		private function error() {
			require('controllers/error.php');
			$this->controller = new error();
			$this->controller->index();
			
			return false;
		}
	}
	