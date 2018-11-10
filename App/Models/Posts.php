<?php
namespace App\Models ;
    class Posts extends Model{
        private $connection = null ;
        public function __construct()
        {
            $this->connection = $this->connect();
        }

        public function getPosts(){
        $result = $this->connection->query('SELECT * FROM posts ');
        return $result->fetch_all(MYSQLI_ASSOC);
        }
    }