<?php

	class controller {
		public $model;
		public $view;
		
		public function __construct() {
			$this->view = new view();
		}
		
		public function use_model($model_name) {
			$suffix = '_model';
			$model_name = $model_name . $suffix;
			$model_file = 'models/' . $model_name . '.php';
			if(file_exists($model_file)) {
				require($model_file);
				$this->model = new $model_name();
			}
		}
	}