<?php

    namespace Bc\Filters;

    /**
     *
     *
     * @author Seif
     */
    class LowercaseFilter implements InputFilterInterface
    {

        public function filter($value)
        {
            return strtolower($value);

        }

    }
