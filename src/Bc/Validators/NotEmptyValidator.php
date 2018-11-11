<?php
    /**
     * Created by PhpStorm.
     * User: Seif
     * Date: 11/11/2018
     * Time: 22:28
     */

    namespace Bc\Validators;


    class NotEmptyValidator implements InputValidatorInterface
    {
        const ERROR_MESSAGE = "Champ obligatoire";

        public function isValid($value)
        {
            return (!is_null($value) && strlen($value) > 0);
        }

        public function getErrorMessage()
        {
            return self::ERROR_MESSAGE;
        }
    }