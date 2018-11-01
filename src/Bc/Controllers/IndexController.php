<?php

namespace Bc\Controllers;

use Home\BaseController;

/**
 * 
 *
 * @author Seif
 */
class IndexController extends BaseController {

    public function indexAction($params) {
        $vars = ['a' => 'Hello'];
        $this->get('Bc\Model\Repository\UserRepository');
        return $this->render('index/index.twig', $vars);
    }

}
