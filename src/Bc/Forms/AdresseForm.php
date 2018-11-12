<?php
    /**
     * Created by PhpStorm.
     * User: Seif
     * Date: 12/11/2018
     * Time: 01:28
     */

    namespace Bc\Forms;


    use Bc\Filters\UpperCaseFilter;
    use Bc\Validators\NotEmptyValidator;
    use Home\Input;
    use Home\InputCollection;

    class AdresseForm extends InputCollection
    {
        public function __construct()
        {
            // libelle
            $inputlibelle = (new Input('libelle'))
                ->addValidator(new NotEmptyValidator())
                ->addFilter(new UpperCaseFilter());

            // wrapper le tout dans un objet (équivalent à un objet de formulaire)
            $this->addInputs(
                [$inputlibelle]
            );
        }
    }