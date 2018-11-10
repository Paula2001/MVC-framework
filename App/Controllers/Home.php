<?php
namespace App\Controllers;
use Core\View;
use App\Models\Posts;
    class Home extends \Core\Controller{
        public function indexAction(){
            $posts = new Posts ;
            $getPosts = $posts->getPosts();
            echo $id ;
            View::renderViews('Home/index.php',$getPosts);
        }
    }