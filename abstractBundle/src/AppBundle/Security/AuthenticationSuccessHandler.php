<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 26-3-2019
 * Time: 19:21
 */

namespace AppBundle\Security;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router;
    protected $authorizationChecker;

    public function __construct(RouterInterface $router, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
    }
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if($this->authorizationChecker->isGranted('ROLE_ADMIN'))
        {
            $response = new RedirectResponse($this->router->generate('admin'));
        }
        elseif ($this->authorizationChecker->isGranted('ROLE_USER'))
        {
            $response = new RedirectResponse($this->router->generate('user'));
        }
        return $response;
    }
}