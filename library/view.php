<?php

class view {

    function render($file_name, $data = '') {
        //data must be array!
        if ($data !== '') {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        if (!is_array($data) and !empty($data)) {
            echo 'Data must be an array!';
        }

        $view_path = 'views/' . $file_name . '.php';
        if (file_exists($view_path)) {
            require $view_path;
        } else {
            // add here a view file that contain error about rendering!!
            echo 'there is not view that you want!';
        }
    }

}

?>
