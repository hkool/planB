<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 23-5-2019
 * Time: 11:50
 */

namespace AppBundle\Handler;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
 protected $router;
 protected $authorizationChecker;

 public function __construct(RouterInterface $router,AuthorizationCheckerInterface $authorizationChecker)
 {
     $this->router = $router;
     $this->authorizationChecker = $authorizationChecker;
 }
    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($this->authorizationChecker->isGranted('ROLE_ADMIN'))
        {
            $response = new RedirectResponse($this->router->generate('admin_index'));
        }
        elseif($this->authorizationChecker->isGranted('ROLE_USER'))
        {
            $response = new RedirectResponse($this->router->generate('user_index'));
        }
        elseif($this->authorizationChecker->isGranted('ROLE_IJSMAKER'))
        {
            $response = new RedirectResponse($this->router->generate('ijsmaker_index'));
        }
        return $response;
    }
}