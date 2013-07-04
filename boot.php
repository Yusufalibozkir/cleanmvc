<?php

class Boot {

    private $controller;
    public $suffix;

    /*
     * $controller is the variable that can reach everywhere!
     * $suffix reserve if there is any defined suffix on the main-config.php
     */

    function __construct($suffix) {

        $this->suffix = $suffix;

        // call index page!
        if (!isset($_GET['url'])) {
            $index_controller = INDEX_CONTROLLER;
            require_once 'controllers/' . $index_controller . '.php';
            $this->controller = new $index_controller();
            $this->controller->index();
            return true;
        }

        //get url
        $url = $this->get_url();

        $file = 'controllers/' . $url[0] . '.php';

        // reach controller

        if (file_exists($file)) {
            require_once $file;
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
        require_once 'controllers/error.php';
        $this->controller = new error();
        $this->controller->index();
        return false;
    }

    private function get_url() {

        /*
         * if suffixs have defined on main-config.php
         */
        if (!empty($this->suffix)) {
            /*
             * @params
             * $getting_url /cnt/mtd/args
             * $url exploded url
             * $count how many part url is
             * $keys defined as like main-config.php
             * $suffix suffix that defined on main-config.php
             * $cut_number lenght of $suffix
             * $get_len length of $getting_url;
             * $url_suffix suffix that come from $getting_url (last number of $suffix characters of $getting_url)
             * 
             * and $url defined again!
             */
            $getting_url = $_GET['url'];
            $url = $this->url();
            $count = count($url);
            $count = $count - 1;
            $keys = array('cnt', 'mtd', 'args');
            $suffix = $this->suffix[$keys[$count]];
            $cut_number = strlen($suffix);
            $get_len = strlen($getting_url) - $cut_number;
            $url_suffix = substr($_GET['url'], $get_len, strlen($getting_url));
            if ($suffix != $url_suffix) {
                return array('error');
            } else {
                $url = explode('/', substr($_GET['url'], 0, -$cut_number));
                $url = $this->create_url($url);
                return $url;
            }
            return;
        } else {
            /*
             * if there is no suffix that defined on main-config.php
             */
            return $url = $this->url();
        }
    }

    private function url() {
        /*
         * Everytime runs first!
         */
        $url = explode('/', trim($_GET['url'], '/'));
        $url = $this->create_url($url);
        return $url;
    }

    private function create_url($url) {

        /*
         * argument joiner function.
         * if there is argument more than one, don't explode it!
         */

        // just define string that will using for foreach
        $str = '';
        foreach ($url as $key => $value) {
            if ($key >= 2) {
                $str = $str . '/' . $value;
            } else {
                $data[] = $value;
            }
        }
        $data[] = trim($str, '/');
        /*
         * if there is empty valued key in the $data array don't add into $result 
         */
        foreach ($data as $data) {
            if (!empty($data)) {
                $result[] = $data;
            }
        }
        // $result is an array!
        return $result;
    }

}

?>
