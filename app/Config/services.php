<?php

return [
    'invokables' => [
        'Bc\Controllers\AdresseController' => Bc\Controllers\AdresseController::class,
        'Bc\Controllers\ContactController' => Bc\Controllers\ContactController::class,
        'Bc\Controllers\IndexController' => Bc\Controllers\IndexController::class,
        'Bc\Filters\FirstLetterUpperFilter' => Bc\Filters\FirstLetterUpperFilter::class,
        'Bc\Filters\LowercaseFilter' => Bc\Filters\LowercaseFilter::class,
        'Bc\Filters\UpperCaseFilter' => Bc\Filters\UpperCaseFilter::class,
        'Bc\Validators\PalindromeValidator' => Bc\Validators\PalindromeValidator::class,
    ],
    'factories' => [
        'Bc\Model\Repository\AdresseRepository' => RepositoryFactory::class,
        'Bc\Model\Repository\ContactRepository' => RepositoryFactory::class,
        'Bc\Model\Repository\UserRepository' => RepositoryFactory::class
    ]
];

