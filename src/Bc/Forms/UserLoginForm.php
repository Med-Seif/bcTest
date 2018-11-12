<?php
    /**
     * Created by PhpStorm.
     * User: Seif
     * Date: 12/11/2018
     * Time: 01:52
     */

    namespace Bc\Forms;


    use Home\InputCollection;
    use Bc\Filters\UpperCaseFilter;
    use Bc\Validators\NotEmptyValidator;
    use Home\Input;

    class UserLoginForm extends InputCollection
    {
        public function __construct()
        {
            // libelle
            $inputLogin = (new Input('login'))
                ->addValidator(new NotEmptyValidator());

            $inputMdp = (new Input('mdp'))
                ->addValidator(new NotEmptyValidator());
            // wrapper le tout dans un objet (équivalent à un objet de formulaire)
            $this->addInputs(
                [
                    $inputLogin,
                    $inputMdp
                ]
            );
        }
    }