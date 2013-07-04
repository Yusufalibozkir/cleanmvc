<?php

class model {

    public $db;

    function __construct() {
        require_once 'library/database.php';
        $this->db = new Database();
    }

}

?>
