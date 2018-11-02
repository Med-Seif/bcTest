<?php

namespace Bc\Controllers;

use Bc\Models\Repository\ContactRepository;
use Home\AbstractBaseController;

/**
 * 
 *
 * @author Seif
 */
class ContactController extends AbstractBaseController {

    public function listAction() {
        $userID = $this->getParam('userID');
        $userRepository = $this->get(\Bc\Models\Repository\UserRepository::class);
        $userRow = $userRepository->findRow($userID);
        if (count($userRow) === 0) {
            throw new \Bc\Exceptions\MissingObjectException();
        }
        $contactRepository = $this->get(ContactRepository::class);
        $contacts = $contactRepository->find([$userID]);
        return $this->render('contact/list.html.twig', ['contacts' => $contacts]);
    }

    public function addAction() {
        $userID = $this->getParam('userID');
        $userRepository = $this->get(\Bc\Models\Repository\UserRepository::class);
        $userRow = $userRepository->findRow($userID);
        if (count($userRow) === 0) {
            throw new \Bc\Exceptions\MissingObjectException();
        }
        if ($this->hasParam('nom')) { // un submit a été envoyé
            $contactRepository = $this->get(ContactRepository::class);
            $contactRepository->insert([
                $this->getParam('nom'),
                $this->getParam('prenom'),
                $this->getParam('email'),
                $userID
            ]);
        }
        return $this->render('contact/add.html.twig', ['userID' => $userID]);
    }

    public function editAction() {
        
    }

}
