<?php
namespace App\Models ;
use mysqli ;
    abstract class Model
    {
        private $con = null;

        public function __construct()
        {

        }
        public function connect(){
            if(!$this->con) {
                $host = 'localhost';
                $name = 'root';
                $passwd = '';
                $dp = 'mvc';
                $this->con = new mysqli($host, $name, $passwd, $dp);
            }
            return $this->con ;
        }

    }