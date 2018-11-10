<?php
namespace App\Controllers;
    class Posts extends \Core\Controller {
        public function index(){
            echo "this is posts index";
            print_r($_GET);
        }
        public function newAction(){
            echo "this is a new post";
        }
        public function editAction(){
            print_r($this->route_params);
        }
    }
