<?php
    /**
     * Created by PhpStorm.
     * User: Seif
     * Date: 12/11/2018
     * Time: 02:31
     */

    namespace Bc\Validators;


    class EmailValidator implements InputValidatorInterface
    {
        const ERROR_MESSAGE = "Adresse mail invalide";

        public function isValid($value)
        {
            return filter_var($value, FILTER_VALIDATE_EMAIL);
        }

        public function getErrorMessage()
        {
            return self::ERROR_MESSAGE;
        }
    }