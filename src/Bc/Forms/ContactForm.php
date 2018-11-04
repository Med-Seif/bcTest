<?php
    /**
     * Created by PhpStorm.
     * User: Seif
     * Date: 04/11/2018
     * Time: 05:17
     */

    namespace Bc\Forms;

    use Home\Input;
    use Home\InputCollection;
    use Bc\Filters\FirstLetterUpperFilter;
    use Bc\Filters\LowercaseFilter;
    use Bc\Validators\PalindromeValidator;

    class ContactForm extends InputCollection
    {
        public function __construct()
        {
            $inputNom = (new Input('nom'))
//                ->setValue($this->getParam('nom'))
                ->addFilter(new FirstLetterUpperFilter())
                ->addValidator(new PalindromeValidator());

            // prénom
            $inputPrenom = (new Input('prenom'))
//                ->setValue($this->getParam('prenom'))
                ->addFilter(new FirstLetterUpperFilter());
            // email
            $inputEmail = (new Input('email'))
//                ->setValue($this->getParam('email'))
                ->addFilter(new LowercaseFilter());
            // wrapper le tout dans un objet (équivalent à un objet de formulaire)
            $this->addInputs(
                [
                    $inputNom,
                    $inputPrenom,
                    $inputEmail
                ]
            );
        }
    }