<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
class DefaultController extends Controller
{
    /**
     * @Route("/home", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Security("has_role('ROLE_ADMIN')")

     * @Route("/test", name="homeAdmin")
     */
    public function adminAction()
    {
    //        return new Response('<html><body>Admin page!</body></html>');
        return $this->render('admin/home.html.twig');
    }

    /**
     * @Route("/inschrijven", name="inschrijven")
     *
     */
    public function registreerAction(Request $request)
    {
        //registreren van nieuwe leden, dmv aanmeldformulier
        // user krijgt de rol ROLE_MEMBER
        $member = new User();
        $form = $this->createForm(UserType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $member = $form->getData();
            $form->get('roles')->setData(['ROLE_MEMBER']);

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($member);
             $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('registratieform.html.twig',
            [
                'form'=> $form->createView()
            ]);
    }

}
