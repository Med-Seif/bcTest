<?php
    /**
     * Created by PhpStorm.
     * User: Seif
     * Date: 03/11/2018
     * Time: 14:09
     */

    namespace Home;


    use Bc\Filters\InputFilterInterface;
    use Bc\Validators\InputValidatorInterface;

    class Input
    {
        protected $name;
        protected $value;
        protected $validators = [];
        protected $filters = [];
        protected $errorMessages = [];

        public function __construct($name)
        {
            $this->name = $name;
        }

        public function addValidator(InputValidatorInterface $validator)
        {
            $this->validators[] = $validator;
            return $this;
        }

        public function addFilter(InputFilterInterface $filter)
        {
            $this->filters[] = $filter;
            return $this;
        }

        public function applyFilters()
        {
            foreach ($this->filters as $filter) {
                $this->value = $filter->filter($this->value);
            }
        }

        public function isValid()
        {

            foreach ($this->validators as $validator) {
                if (!$validator->isValid($this->value)) {
                    $this->errorMessages[] = $validator->getErrorMessage();
                }

            }
            return (count($this->errorMessages) == 0);
        }

        /**
         * @return mixed
         */
        public function getName()
        {
            return $this->name;
        }

        public function setValue($value)
        {
            $this->value = $value;
            return $this;
        }

        public function getValue()
        {
            $this->applyFilters();
            return $this->value;
        }

        public function getErrorMessages()
        {
            return $this->errorMessages;
        }
    }