<?php
/**
 * Created by PhpStorm.
 * User: Seif
 * Date: 14/12/2018
 * Time: 02:41
 */

namespace Bc\Security;


class BcAuthenticator
{
    public function checkAccess()
    {
        $providers = array(new BcAuthProvider());
        $authenticatedToken = null;
        $authenticationManager = new BcAuthManager($providers);
        $unauthenticatedToken = new BcToken();
        try {
            $authenticatedToken = $authenticationManager
                ->authenticate($unauthenticatedToken);
        } catch (AuthenticationException $exception) {
            // authentication failed
        }
        return $authenticatedToken;
    }
}