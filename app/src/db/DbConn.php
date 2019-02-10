<?php

namespace Blog\Db;

use Dibi\Connection;

class DbConn 
{

    private $db;

    
    
    function getConnection()
    {
        $this->db = new Dibi\Connection([
            'driver' => 'mysqli',
            'host' => 'db',
            'username' => 'root',
            'password' => 'root',
            'database' => 'blog',
        ]);
        return $this->db;
    }

}