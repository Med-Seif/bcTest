<?php

namespace Bc\Controllers;

use Bc\Forms\UserLoginForm;
use Bc\Models\Repository\UserRepository;
use Home\AbstractBaseController;
use Home\AuthentificationSession;
use Home\User;

/**
 * Description of UserController
 *
 * @author Seif
 */
class UserController extends AbstractBaseController
{

    public function loginAction()
    {
        if (!$this->hasParam('login')) {
            return $this->render('user/login.html.twig');
        }
        // un submit a été envoyé
        $form = new UserLoginForm();
        $form->setValue('login', $this->getParam('login'));
        $form->setValue('mdp', $this->getParam('mdp'));
        if ($form->isValid()) {
            $id = $this->get(UserRepository::class)->authenticateUser(
                $form->getValue('login'),
                $form->getValue('mdp')
            );
            if ($id) {
                // Authentification réussie
                $user = new User();
                $user->setId($id);
                $user->setUsername($form->getValue('login'));
                $authService = new AuthentificationSession();
                $authService->saveSession($user);
                $this->redirect('contact/list?userID=' . $id);
            }
        }
        // Authentification échouée
        return $this->render('user/login.html.twig',
            ['msg' => 'Login ou mot de passe incorrecte(s)']);
    }

    public function logoutAction()
    {
        $this->get('auth')->destroyAuthSession();
        return $this->render('user/login.html.twig');
    }
}
