<?php

    namespace Bc\Validators;

    /**
     *
     *
     * @author Seif
     */
    class PalindromeValidator implements InputValidatorInterface
    {
        const ERROR_MESSAGE = "Ne peut pas être palindrome";

        public function isValid($value)
        {
            $reverse = strrev($value);

            if ($value == $reverse) {
                return false;
            }
            return true;
        }

        public function getErrorMessage()
        {
            return self::ERROR_MESSAGE;
        }

    }
