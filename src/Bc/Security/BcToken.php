<?php
/**
 * Created by PhpStorm.
 * User: Seif
 * Date: 14/12/2018
 * Time: 00:10
 */

namespace Bc\Security;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class BcToken extends AbstractToken
{

    /**
     * Returns the user credentials.
     *
     * @return mixed The user credentials
     */
    public function getCredentials()
    {
        // TODO: Implement getCredentials() method.
    }
}