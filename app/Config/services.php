<?php

return [

    'Bc\Filters\FirstLetterUpperFilter' => Bc\Filters\FirstLetterUpperFilter::class,
    'Bc\Filters\LowercaseFilter' => Bc\Filters\LowercaseFilter::class,
    'Bc\Filters\UpperCaseFilter' => Bc\Filters\UpperCaseFilter::class,
    'Bc\Validators\PalindromeValidator' => Bc\Validators\PalindromeValidator::class,
    'Bc\Model\Repository\AdresseRepository' => Bc\Services\Factories\RepositoryFactory::class,
    'Bc\Model\Repository\ContactRepository' => Bc\Services\Factories\RepositoryFactory::class,
    'Bc\Model\Repository\UserRepository' => Bc\Services\Factories\RepositoryFactory::class,
];

