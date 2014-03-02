<?php

class view {

    function render($file_name, Array $data = null) {

        $view_path = 'views/' . $file_name . '.php';

        if (is_file($view_path)) {
            
            // güvenli alanda çalıştırılsın.
            // view nesnesine doğrudan erişemesin.
            call_user_func(function(){
                
                extract((array)func_get_args(1));
                require func_get_args(0);
                
            }, $view_path, $data);

        } else {
            // add here a view file that contain error about rendering!!
            throw new Exception('there is not view that you want!');
        }
    }
}
