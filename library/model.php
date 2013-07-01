<?php

	class model {
		public $db;
		
		public function __construct() {
			require('library/database.php');
			$this->db = new Database();
		}
		
	}