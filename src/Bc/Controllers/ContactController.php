<?php

    namespace Bc\Controllers;

    use Bc\Filters\FirstLetterUpperFilter;
    use Bc\Filters\LowercaseFilter;
    use Bc\Models\Repository\ContactRepository;
    use Bc\Validators\PalindromeValidator;
    use Home\AbstractBaseController;
    use Home\Input;
    use Home\InputCollection;

    /**
     *
     *
     * @author Seif
     */
    class ContactController extends AbstractBaseController
    {

        public function listAction()
        {
            $userID = $this->getParam('userID');
            $userRepository = $this->get(\Bc\Models\Repository\UserRepository::class);
            if (!$userRepository->userExists($userID)) {
                throw new \Bc\Exceptions\MissingObjectException();
            }
            $contactRepository = $this->get(ContactRepository::class);
            $contacts = $contactRepository->find([$userID]);
            return $this->render('contact/list.html.twig', ['contacts' => $contacts, 'user_id' => $userID]);
        }

        public function addAction()
        {

            $userID = $this->getParam('userID');
            if (!$this->get(\Bc\Models\Repository\UserRepository::class)->userExists($userID)) {
                throw new \Bc\Exceptions\MissingObjectException();
            }
            if (!$this->hasParam('nom')) {
                return $this->render('contact/add.html.twig', ['userID' => $userID]);
            }
            // un submit a été envoyé
            // nom
            $inputNom = (new Input('nom'))
                ->setValue($this->getParam('nom'))
                ->addFilter(new FirstLetterUpperFilter())
                ->addValidator(new PalindromeValidator());

            // prénom
            $inputPrenom = (new Input('prenom'))
                ->setValue($this->getParam('prenom'))
                ->addFilter(new FirstLetterUpperFilter());
            // email
            $inputEmail = (new Input('email'))
                ->setValue($this->getParam('email'))
                ->addFilter(new LowercaseFilter());
            // wrapper le tout dans un objet (équivalent à un objet de formulaire)
            $collection = new InputCollection();
            $collection->addInputs(
                [
                    $inputNom,
                    $inputPrenom,
                    $inputEmail
                ]
            );
            if ($collection->isValid()) {
                $this->get(ContactRepository::class)->insert([
                    $inputNom->getValue(),
                    $inputPrenom->getValue(),
                    $inputEmail->getValue(),
                    $userID
                ]);
                $this->redirect('/contact/list?userID=' . $userID);
            }
            var_dump($collection->getErrors());
            return $this->render('contact/add.html.twig', ['userID' => $userID]);
        }


        public function editAction()
        {
            $id = $this->getParam('id');
            if (!$this->get(ContactRepository::class)->contactExists($id)) {
                throw new \Bc\Exceptions\MissingObjectException();
            }
            if (!$this->hasParam('nom')) {
                return $this->render('contact/edit.html.twig', ['$id' => $id]);
            }
            // un submit a été envoyé
            // nom
            $inputNom = (new Input('nom'))
                ->setValue($this->getParam('nom'))
                ->addFilter(new FirstLetterUpperFilter())
                ->addValidator(new PalindromeValidator());

            // prénom
            $inputPrenom = (new Input('prenom'))
                ->setValue($this->getParam('prenom'))
                ->addFilter(new FirstLetterUpperFilter());
            // email
            $inputEmail = (new Input('email'))
                ->setValue($this->getParam('email'))
                ->addFilter(new LowercaseFilter());
            // wrapper le tout dans un objet (équivalent à un objet de formulaire)
            $collection = new InputCollection();
            $collection->addInputs(
                [
                    $inputNom,
                    $inputPrenom,
                    $inputEmail
                ]
            );
            if ($collection->isValid()) {
                $this->get(ContactRepository::class)->update([
                    $inputNom->getValue(),
                    $inputPrenom->getValue(),
                    $inputEmail->getValue(),
                    $id
                ]);
                $this->redirect('/contact/list?userID=' . $userID);
            }
            var_dump($collection->getErrors());
            return $this->render('contact/add.html.twig', ['userID' => $userID]);

        }

    }
