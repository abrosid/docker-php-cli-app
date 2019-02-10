<?php

namespace Blog\Repo;

class BaseRepository{

    protected $db;

    protected function getConnection()
    {
        if (!$this->db) {
            $this->db = \dibi::connect([
                'driver' => 'mysqli',
                'host' => 'db',
                'username' => 'root',
                'password' => 'root',
                'database' => 'blog',
            ]);
        }
        return $this->db;
    }



}