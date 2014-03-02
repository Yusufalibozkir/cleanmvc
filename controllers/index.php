<?php

class index extends controller
{
    protected $file;

    protected function oncreate() {
        $this->file = 'index';
    }

    function index() {
        $this->view->render($this->file);
    }
}
