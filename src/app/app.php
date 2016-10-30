<?php

use Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider;
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Doctrine\DBAL\Schema\Table;
use Silex\Provider\DoctrineServiceProvider;

use Doctrine\ORM\Query;
use Bakendo\Entity\User;

use Bakendo\SugarPasswordEncoder;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
}));




$app->register(new DoctrineOrmServiceProvider, array(
    //"orm.proxies_dir" => "/path/to/proxies",
    "orm.em.options" => array(
        "mappings" => array(
            // Using actual filesystem paths
            array(
                "type" => "annotation",
                "namespace" => 'Bakendo\Entity',
                //"path" => __DIR__."/src/Bakendo/Entity",
                "path" => "/home/tineo/makinap.com/public/bakendo/src/Bakendo/Entity",

            ),
           /* array(
                "type" => "xml",
                "namespace" => "Bakendo\Entities",
                "path" => __DIR__."/src/Bat/Resources/mappings",
            ),*/
        ),
    ),
));

$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider());

$app['security.firewalls'] = array(

        'secured' => array(
            //'pattern' => '^/admin',
            'pattern' => '^.*$',
            'anonymous' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login/check'),
            'logout' => array('logout_path' => '/logout'),
            'users' => $app->share(function () use ($app) {
                return new Bakendo\UserProvider($app['orm.em']);
            }),
        ),
);

$app['security.role_hierarchy'] = array(
    'ROLE_ADMIN'    => array('ROLE_STAFF', 'ROLE_BAN_MGR', 'ROLE_IMPERSONATE'),
    'ROLE_STAFF'    => array('ROLE_USER'),
);

$app['security.access_rules'] = array(
    //array('^/admin', 'ROLE_ADMIN', 'https'),
    array('^/login','IS_AUTHENTICATED_ANONYMOUSLY'),
    array('^.*$', 'ROLE_USER'),
    //array('^.*$','IS_AUTHENTICATED_ANONYMOUSLY'),
    //array('^/*$', 'ROLE_USER'),


);



$app['security.encoder.digest'] = $app->share(function ($app) {
    return new SugarPasswordEncoder();
});

return $app;
