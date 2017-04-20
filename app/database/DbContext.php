<?php

namespace App\Database;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;

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
        if($_SERVER['SERVER_NAME'] != "localhost"){
            // ====================== DB REMOTE CONNECTION ======================

             // Doctrine db settings
        $paths = array("/path/to/entity-files");
        $isDevMode = true;
        $dbParams = null;

            // ====================== LOCAL DB CONNTECTION ======================
            $dbParams = array(
                'driver'   => 'pdo_mysql',
                'user'     => 'hiobairo',
                'password' => 'admin1234',
                'dbname'   => 'renovaspa',
            );
        
        

            // DB configuration and Doctrine Entity Manager
            $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
            $entityManager = EntityManager::create($dbParams, $config);
            
        }
        else {
            // ====================== LOCAL DB CONNTECTION ======================
            $applicationMode = "development";

            if($applicationMode == "development")
                $cache = new \Doctrine\Common\Cache\ArrayCache;
            else
                $cache = new \Doctrine\Common\Cache\ApcCache;

            $config = new Configuration;
            $config->setMetadataCacheImpl($cache);
            $driverImpl = $config->newDefaultAnnotationDriver(__DIR__."/app/models/test");
            $config->setMetadataDriverImpl($driverImpl);
            $config->setQueryCacheImpl($cache);
            $config->setProxyDir(__DIR__."/data/DoctrineORMModule/Proxy");
            $config->setProxyNamespace("Renovaspa\Proxies");

            if($applicationMode == "development")
                $config->setAutoGenerateProxyClasses(true);
            else
                $config->setAutoGenerateProxyClasses(false);

            // define credentials...
            // $connectionOptions = array(
            //     'driver'   => 'pdo_mysql',
            //     'host'     => '66.147.254.159',
            //     'dbname'   => 'renovasp_newrenova',
            //     'user'     => 'renovasp_renovan',
            //     'password' => 'r3n0v42016',
            // );

             $connectionOptions = array(
                'driver'   => 'pdo_mysql',
                'host'     => 'localhost',
                'dbname'   => 'final_renova',
                'user'     => 'root',
                'password' => 'root',
            );
        }

        

        return EntityManager::create($connectionOptions, $config);
    }
}