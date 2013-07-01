<?php

	class index extends controller {
		public function __construct() {
			parent::__construct();
		}
		
		public function index() {
			$this->view->render('index');
		}
	}