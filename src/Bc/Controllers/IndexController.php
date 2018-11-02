<?php

namespace Bc\Controllers;

use Home\AbstractBaseController;

/**
 * 
 *
 * @author Seif
 */
class IndexController extends AbstractBaseController {

    public function indexAction() {
        $vars = ['msg' => 'Hello'];
        $this->get(\Bc\Models\Repository\UserRepository::class);
        return $this->render('index/index.html.twig', $vars);
    }

}
