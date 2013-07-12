<?php

class controller {

    public $model;
    public $view;
    public $cache;

    public function __construct() {
        $this->view = new view();
        if (IS_CACHE_ON) {
            $this->load_cache();
        }
    }

    public function use_model($model_name) {
        $suffix = '_model';
        $model_name = $model_name . $suffix;
        $model_file = 'models/' . $model_name . '.php';
        if (file_exists($model_file)) {
            require_once $model_file;
            $this->model = new $model_name();
        }
    }

    public function load_cache() {
        require_once 'library/cache.php';
        $this->cache = new cache();
    }

}

?>
