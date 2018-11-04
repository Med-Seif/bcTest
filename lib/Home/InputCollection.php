<?php
    /**
     * Created by PhpStorm.
     * User: Seif
     * Date: 03/11/2018
     * Time: 14:09
     */

    namespace Home;


    use http\Exception\InvalidArgumentException;

    class InputCollection
    {
        protected $inputs = [];
        protected $errors = [];

        public function addInput(Input $input)
        {
            $this->inputs[$input->getName()] = $input;
            return $this;
        }

        public function addInputs(array $inputs)
        {
            foreach ($inputs as $input) {
                $this->addInput($input);
            }
        }

        public function isValid()
        {
            foreach ($this->inputs as $input) {
                if (!$input->isValid()) {
                    $this->addError($input->getName(), $input->getErrorMessages());
                }
                return count($this->errors) == 0;
            }
        }

        public function getErrors()
        {
            return $this->errors;

        }

        public function addError($inputName, $error)
        {
            $this->errors[$inputName] = $error;
        }
    }