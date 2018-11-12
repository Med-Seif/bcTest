<?php
    /**
     * Created by PhpStorm.
     * User: Seif
     * Date: 12/11/2018
     * Time: 02:34
     */

    namespace Bc\Controllers;


    use Bc\Validators\EmailValidator;
    use Home\AbstractBaseController;

    class ApiController extends AbstractBaseController
    {
        public function isValidEmailAction()
        {
            $email = $this->getParam('email');
            $emailValidator = new EmailValidator();
            return json_encode($emailValidator->isValid($email));
        }
    }