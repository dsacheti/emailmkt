<?php
return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'homestead',
                    'password' => 'secret',
                    'dbname' => 'bd_email_mkt',
                    'driverOptions' => [
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES `UTF8`"
                    ]
                ]
            ]
        ],
        'driver' => [
            'EmailMkt_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\YamlDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../../src/EmailMkt/Infrastructure/Persistence/Doctrine/ORM']
            ],
            'orm_default' => [
                'drivers' => [
                    'EmailMkt\Domain\Entity' => 'EmailMkt_driver'
                ]
            ]
        ],
        'authentication' => array(
            'orm_default' => array(
                'object_manager' => Doctrine\ORM\EntityManager::class,
                'identity_class' => \EmailMkt\Domain\Entity\User::class,
                'identity_property' => 'email',
                'credential_property' => 'password',
                'credential_callable' => function(\EmailMkt\Domain\Entity\User $user,$passordGiven){
                    return password_verify($passordGiven,$user->getPassword());
                }
            ),
        ),
    ]
];