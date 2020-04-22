<?php

namespace Src\DAO;

use \PDO;

class Connection
{
    /**
     * @var \PDO
     */
    protected $pdo;

    public function __construct()
    {

        try {
            return $this->pdo = new PDO(
                'mysql:host=localhost;dbname=slim',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        } catch (\PDOException $erro) {
            return $erro->getMessage();
        }
    }
}
