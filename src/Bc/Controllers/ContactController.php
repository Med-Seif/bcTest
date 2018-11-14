<?php

    namespace Bc\Controllers;

    use Bc\Forms\ContactForm;
    use Bc\Models\Repository\ContactRepository;
    use Home\AbstractBaseController;

    /**
     *
     *
     * @author Seif
     */
    class ContactController extends AbstractBaseController
    {
        public function listAction()
        {
            $user = $this->checkAccess();
            $userID = $user['id'];
            $userRepository = $this->get(\Bc\Models\Repository\UserRepository::class);
            if (!$userRepository->findRow($userID)) {
                throw new \Bc\Exceptions\MissingObjectException();
            }
            $contactRepository = $this->get(ContactRepository::class);
            $contacts = $contactRepository->find([$userID]);
            return $this->render('contact/list.html.twig', ['contacts' => $contacts, 'user_id' => $userID]);
        }

        public function addAction()
        {
            $user = $this->checkAccess();
            $userID = $user['id'];
            if (!$this->get(\Bc\Models\Repository\UserRepository::class)->findRow($userID)) {
                throw new \Bc\Exceptions\MissingObjectException();
            }
            if (!$this->hasParam('nom')) {
                return $this->render('contact/add.html.twig', ['userID' => $userID]);
            }
            // un submit a été envoyé
            // wrapper le tout dans un objet (équivalent à un objet de formulaire)
            $form = new ContactForm();
            $form->setValue('nom', $this->getParam('nom'));
            $form->setValue('prenom', $this->getParam('prenom'));
            $form->setValue('email', $this->getParam('email'));
            if ($form->isValid()) {
                $this->get(ContactRepository::class)->insert([
                    $form->getValue('nom'),
                    $form->getValue('prenom'),
                    $form->getValue('email'),
                    $userID
                ]);
                $this->redirect('/contact/list?userID=' . $userID);
            }
            // Validation échouée
            return $this->render('contact/add.html.twig',
                [
                    'userID' => $userID,
                    'formErrors' => $form->getErrorMassages()
                ]
            );
        }


        public function editAction()
        {
            $user = $this->checkAccess();
            $id = $this->getParam('id');
            if (!$contactRow = $this->get(ContactRepository::class)->findRow($id)) {
                throw new \Bc\Exceptions\MissingObjectException();
            }
            if (!$this->hasParam('nom')) {
                return $this->render('contact/edit.html.twig', [
                    'id' => $id,
                    'nom' => $contactRow['nom'],
                    'prenom' => $contactRow['prenom'],
                    'email' => $contactRow['email'],
                ]);
            }
            // un submit a été envoyé
            $form = new ContactForm();
            $form->setValue('nom', $this->getParam('nom'));
            $form->setValue('prenom', $this->getParam('prenom'));
            $form->setValue('email', $this->getParam('email'));
            if ($form->isValid()) {
                $this->get(ContactRepository::class)->update([
                    $form->getValue('nom'),
                    $form->getValue('prenom'),
                    $form->getValue('email'),
                    $id
                ]);
                $this->redirect('/contact/list?userID=' . $contactRow['users_id']);
            }
            // Validation échouée
            return $this->render('contact/edit.html.twig',
                [
                    'id' => $contactRow['id'],
                    'formErrors' => $form->getErrorMassages()
                ]
            );

        }

    }
