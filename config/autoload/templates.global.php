<?php

return [
    'dependencies' => [
        'factories' => [
            'Zend\Expressive\FinalHandler' =>
                Zend\Expressive\Container\TemplatedErrorHandlerFactory::class,
            //serviço responsável por transformar código do twig para poder mostrar na tela do site
            Zend\Expressive\Template\TemplateRendererInterface::class =>
                \EmailMkt\Infrastructure\View\Twig\TwigRendererFactory::class,
        ],
    ],

    'templates' => [
        'extension' => 'html.twig',
        'paths'     => [
            'app'    => ['templates/app'],
            'layout' => ['templates/layout'],
            'error'  => ['templates/error'],
        ],
    ],

    'twig' => [
        'cache_dir'      => null,//'data/cache/twig',//colocando este valor como null parace desativar o cache
        'assets_url'     => '/',
        'assets_version' => null,
        'extensions'     => [
            // extension service names or instances
        ],
    ],
];
