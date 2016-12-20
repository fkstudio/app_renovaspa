<?php

namespace App\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class DbContext
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager = null;

    /** 
     * getEntityManager
     * @return \Doctrine\ORM\EntityManager object
     */
    public function getEntityManager()
    {
        if ($this->entityManager === null) {
            $this->entityManager = $this->createEntityManager();
        }

        return $this->entityManager;
    }

    /**
     * createEntityManager
     * @return EntityManager object
     */
    public function createEntityManager()
    {
        $path = array('../Models');
        $devMode = true;

        $config = Setup::createAnnotationMetadataConfiguration($path, $devMode);

        // define credentials...
        $connectionOptions = array(
            'driver'   => 'pdo_mysql',
            'host'     => 'localhost',
            'dbname'   => 'renovatest',
            'user'     => 'root',
            'password' => 'root',
        );

        return EntityManager::create($connectionOptions, $config);
    }
}
