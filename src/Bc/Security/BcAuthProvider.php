<?php
/**
 * Created by PhpStorm.
 * User: Seif
 * Date: 14/12/2018
 * Time: 02:56
 */

namespace Bc\Security;


use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class BcAuthProvider implements AuthenticationProviderInterface
{

    /**
     * Attempts to authenticate a TokenInterface object.
     *
     * @param TokenInterface $token The TokenInterface instance to authenticate
     *
     * @return TokenInterface An authenticated TokenInterface instance, never null
     *
     * @throws AuthenticationException if the authentication fails
     */
    public function authenticate(TokenInterface $token)
    {
        // TODO: Implement authenticate() method.
    }

    /**
     * Checks whether this provider supports the given token.
     *
     * @return bool true if the implementation supports the Token, false otherwise
     */
    public function supports(TokenInterface $token)
    {
        // TODO: Implement supports() method.
    }
}