<?php

namespace App\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;

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
        // Doctrine db settings
        $paths = array("/path/to/entity-files");
        $isDevMode = true;
        $dbParams = null;

            // ====================== LOCAL DB CONNTECTION ======================
            $dbParams = array(
                'driver'   => 'pdo_mysql',
                'host' => '45.58.47.61',
                'user'     => 'hiobairo',
                'password' => 'admin1234',
                'dbname'   => 'final_renova',
            );

            // $dbParams = array(
            //     'driver'   => 'pdo_mysql',
            //     'user'     => 'root',
            //     'password' => 'root',
            //     'dbname'   => 'final_renova',
            // );
        
        

        // DB configuration and Doctrine Entity Manager
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $entityManager = EntityManager::create($dbParams, $config);
        
        return $entityManager;
    }
}