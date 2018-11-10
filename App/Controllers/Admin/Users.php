<?php

namespace App\Controllers\Admin;


class Users extends \Core\Controller
{

    protected function before()
    {
        return false ;
    }

    public function indexAction()
    {
        echo 'User admin index';
    }
}
