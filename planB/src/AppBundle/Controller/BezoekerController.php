<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 23-5-2019
 * Time: 11:28
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class BezoekerController extends Controller
{
    /**
     * @Route("/login", name="login")
     *
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the ijsmaker
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('bezoeker/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'link'=>'inloggen'
        ]);
    }
    /**
     * laat de homepage van de bezoeker zien
     *
     * @Route("/", name="bezoeker_index")
     *
     */
    public function indexAction()
    {
        return $this->render('bezoeker/index.html.twig', array(
            'link' => 'home'
        ));
    }
    /**
     * Lists all recept entities.
     *
     * @Route("/recepten/", name="bezoeker_indexrecept")
     *
     */
    public function indexReceptAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recepts = $em->getRepository('AppBundle:Recept')->findAll();

        return $this->render('bezoeker/recept/index.html.twig', array(
            'recepts' => $recepts,
            'link'=> "recepten"
        ));
    }


}