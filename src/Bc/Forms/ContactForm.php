<?php
    /**
     * Created by PhpStorm.
     * User: Seif
     * Date: 04/11/2018
     * Time: 05:17
     */

    namespace Bc\Forms;

    use Bc\Validators\NotEmptyValidator;
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
                ->addValidator(new NotEmptyValidator())
                ->addValidator(new PalindromeValidator())
                ->addFilter(new FirstLetterUpperFilter());

            // prénom
            $inputPrenom = (new Input('prenom'))
                ->addValidator(new NotEmptyValidator())
                ->addFilter(new FirstLetterUpperFilter());
            // email
            $inputEmail = (new Input('email'))
                ->addValidator(new NotEmptyValidator())
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