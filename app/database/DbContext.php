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
            'dbname'   => 'newrenova',
            'user'     => 'root',
            'password' => 'root',
        );

        return EntityManager::create($connectionOptions, $config);
    }
}