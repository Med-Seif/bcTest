<?php
    /**
     * Created by PhpStorm.
     * User: Seif
     * Date: 03/11/2018
     * Time: 14:09
     */

    namespace Home;


    use Bc\Exceptions\FormInputNotFoundException;

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

        public function getInput($inputName)
        {
            if (!array_key_exists($inputName, $this->inputs)) {
                throw new FormInputNotFoundException();
            }
            return $this->inputs[$inputName];
        }

        public function isValid()
        {
            foreach ($this->inputs as $input) {
                if (!$input->isValid()) {
                    $this->addError($input->getName(), $input->getErrorMessages());
                }
            }
            return count($this->errors) == 0;
        }

        public function getErrors()
        {
            return $this->errors;

        }

        public function addError($inputName, $error)
        {
            $this->errors[$inputName] = $error;
        }

        public function setValue($inputName, $value)
        {
            $this->getInput($inputName)->setValue($value);
        }

        public function getValue($inputName)
        {
            return $this->getInput($inputName)->getValue();
        }

        public function getErrorMassages()
        {
            $errorMessages = [];
            foreach ($this->getErrors() as $input => $errors) {
                $errorMessages[] = $input . ' : ' . implode(' | ', $errors);
            }
            return $errorMessages;
        }

        public function getValues()
        {
            $values = [];
            foreach ($this->inputs as $input) {
                $values [$input->getName()] = $input->getValue();
            }
            return $values;
        }
    }