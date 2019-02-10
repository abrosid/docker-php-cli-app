<?php

namespace Blog\Repo;


class UserRepository extends BaseRepository
{

    public function saveUser(array $userArr)
    {
        $this->getConnection()->query('INSERT INTO users', $userArr, 'ON DUPLICATE KEY UPDATE %a', array_splice($userArr, 1));
    }

    public function saveUserAddress(array $addressArr)
    {
        $this->getConnection()->query('INSERT INTO addresses', $addressArr, 'ON DUPLICATE KEY UPDATE %a', array_splice($addressArr, 1));
    }

    public function saveUserCompany(array $companyArr)
    {
        $this->getConnection()->query('INSERT INTO companies', $companyArr, 'ON DUPLICATE KEY UPDATE %a', array_splice($companyArr, 1));
    }

}
