<?php

class cache extends Memcache {

    /********************** Example usage of cache library! >>> **********************
    *  $keys = array('database','saffet');
    *  if(!$this->cache->checkDatas($keys))
    *  {
    *  $this->cache->recieveData('the data that coming from database!', $keys[0], 60);
    *  $this->cache->recieveData('saffet is the my favorite word', $keys[1], 60);
    *  $this->cache->exec_cache();
    *  }
    *  echo $this->cache->getData('database');
    *  print_r($this->cache->getAllDatas()); 
    ************************************** END ***************************************/
    
    public $datas = [];
    public $keys = [];
    public $durations = [];
    public $keys_for_check;
    private $error;

    function __construct() {
        //parent::__construct();
        /*
         * Connect Memcache!
         */
        $this->connect(MEM_HOST, MEM_PORT) or die('There is no Memcache on your server!');
    }

    /*
     * Just define a data that will be cached!
     */

    public function recieveData($data, $key, $duration) {
        /*
         * receiveDatas to execute with
         * cache::exec_cache();
         */
        $this->datas[] = $data;
        $this->keys[] = $key;
        $this->durations[] = $duration;
    }

    private function check_keys($key) {
        /*
         * $key must be an array!
         * calling from checkDatas!
         */
        $this->keys_for_check = $key;
    }

    public function exec_cache() {
        /* execute received datas! */
        foreach ($this->keys as $key => $value) {
            $this->add($value, $this->datas[$key], false, $this->durations[$key]);
        }
    }

    public function checkDatas($keys) {
        /*
         * Created for checking are datas checked
         */
        $this->check_keys($keys);

        $this->error = true;
        foreach ($this->keys_for_check as $key) {
            if ($this->get($key)) {
                /*
                 * It's good try other keys!
                 * Don't do anything!
                 */
            } else {
                return false;
            }
            return true;
        }
    }

    private function write_err() {
        /*
         * If datas haven't checked say him/her
         * call checkDatas function!
         */
        if (!$this->error) {
            die('<b>call cache::checkDatas() function before!</b>');
        }
    }

    public function getData($key) {
        /*
         * get single data!
         */
        $this->write_err();
        return $this->get($key);
    }

    function getAllDatas() {
        /*
         * get all datas
         */
        $this->write_err();
        if (empty($this->keys))
            $variable_name = 'keys_for_check';
        else
            $variable_name = 'keys';

        foreach ($this->{$variable_name} as $key) {
            $data[$key] = $this->get($key);
        }

        return $data;
    }
}

?>
