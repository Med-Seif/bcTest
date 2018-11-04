<?php

    namespace Bc\Validators;

    /**
     *
     * @author Seif
     */
    interface InputValidatorInterface
    {

        public function isValid($value);

        public function getErrorMessage();
    }
