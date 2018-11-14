<?php

return [

    'Bc\Filters\FirstLetterUpperFilter'      => Bc\Filters\FirstLetterUpperFilter::class,
    'Bc\Filters\LowercaseFilter'             => Bc\Filters\LowercaseFilter::class,
    'Bc\Filters\UpperCaseFilter'             => Bc\Filters\UpperCaseFilter::class,
    'Bc\Validators\PalindromeValidator'      => Bc\Validators\PalindromeValidator::class,
    'Bc\Models\Repository\AdresseRepository' => Bc\Services\Factories\RepositoryFactory::class,
    'Bc\Models\Repository\ContactRepository' => Bc\Services\Factories\RepositoryFactory::class,
    'Bc\Models\Repository\UserRepository'    => Bc\Services\Factories\RepositoryFactory::class,
    'auth'                                   => \Home\AuthentificationSession::class
];

