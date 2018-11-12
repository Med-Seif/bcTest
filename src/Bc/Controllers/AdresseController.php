<?php

    namespace Bc\Controllers;

    use Bc\Forms\AdresseForm;
    use Bc\Models\Repository\AdresseRepository;
    use Home\AbstractBaseController;

    /**
     *
     *
     * @author Seif
     */
    class AdresseController extends AbstractBaseController
    {
        public function listAction()
        {
            $contactID = $this->getParam('contactID');
            $contactRepository = $this->get(\Bc\Models\Repository\ContactRepository::class);
            if (!$contactRepository->findRow($contactID)) {
                throw new \Bc\Exceptions\MissingObjectException();
            }
            $adresseRepository = $this->get(AdresseRepository::class);
            $adresses = $adresseRepository->find([$contactID]);
            return $this->render('adresse/list.html.twig', ['adresses' => $adresses, 'contact_id' => $contactID]);
        }

        /**
         * @return mixed
         * @throws \Bc\Exceptions\MissingObjectException
         */
        public function editAction()
        {
            $id = $this->getParam('id');
            if (!$adresseRow = $this->get(AdresseRepository::class)->findRow($id)) {
                throw new \Bc\Exceptions\MissingObjectException();
            }
            if (!$this->hasParam('libelle')) {
                return $this->render('adresse/edit.html.twig', [
                    'id' => $id,
                    'libelle' => $adresseRow['libelle']
                ]);
            }
            // un submit a été envoyé
            $form = new AdresseForm();
            $form->setValue('libelle', $this->getParam('libelle'));

            if ($form->isValid()) {
                $this->get(AdresseRepository::class)->update([
                    $form->getValue('libelle'),
                    $id
                ]);
                $this->redirect('/adresse/list?contactID=' . $adresseRow['contacts_id']);
            }
            // Validation échouée
            return $this->render('adresse/edit.html.twig',
                [
                    'id' => $adresseRow['id'],
                    'formErrors' => $form->getErrorMassages()
                ]
            );
        }
    }
