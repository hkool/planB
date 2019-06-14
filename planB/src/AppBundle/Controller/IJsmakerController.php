<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 23-5-2019
 * Time: 11:58
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Recept;
use Symfony\Component\Form\FormError;
use AppBundle\Form\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Ijsmaker controller.
 *
 * @Route("ijsmaker")
 */
class IJsmakerController extends Controller
{
    /**
     * Laat een lijst zien van al het fruit
     *
     * @Route("/", name="ijsmaker_index")
     *
     */
    public function indexAction()
    {
        return $this->render('ijsmaker/index.html.twig', array(
            'link'=> "home"
        ));
    }
    /**
     * @Route("/wijzigwachtwoord/",name="wijzigWachtwoord")
     */
    function wijzigWachtwoordAction (Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $passwordEncoder = $this->get('security.password_encoder');
            $oldPassword = $form->get('oldPassword')->getData();
            $plainPassword = $form->get('plainPassword')->getData();

            // Als het oude wachtwoord juist is:
            if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {
                $newEncodedPassword = $passwordEncoder->encodePassword($user, $plainPassword);
                $user->setPassword($newEncodedPassword);

                $em->persist($user);
                $em->flush();

                $this->addFlash('notice', 'Uw wachtwoord is gewijzigd!');

                return $this->redirectToRoute('ijsmaker_index');
            } else {
                $form->addError(new FormError('Oude wachtwoord is niet correct!'));
            }
        }

        return $this->render('ijsmaker/editPassword.html.twig', array(
            'form' => $form->createView(),
            'link' => 'home'
        ));
    }


    /**
     * @Route("/ijsmaker/bestellingen/", name="ijsmaker_overzichtbestellingen")
     */
    public function bestellingenBekijkenAction()
    { $em = $this->getDoctrine()->getManager();

        $bestellingen = $em->getRepository('AppBundle:Bestelling')->findAll();

        return $this->render('ijsmaker/bestelling/index.html.twig', array(
            'bestellingen' => $bestellingen,
            'link'=> "bestellingen"
        ));

    }
    /**
     * @Route("/ijsmaker/recepten/", name="ijsmaker_indexrecept")
     */
    public function receptenBekijkenAction()
    { $em = $this->getDoctrine()->getManager();

        $recepts = $em->getRepository('AppBundle:Recept')->findAll();

        return $this->render('ijsmaker/recept/index.html.twig', array(
            'recepts' => $recepts,
            'link'=> "recepten"
        ));

    }
    /**
     * Finds and displays a recept entity.
     *
     * @Route("/recept/show/{id}", name="ijsmaker_showrecept")
     *
     */
    public function showReceptAction(Recept $recept)
    {


        return $this->render('ijsmaker/recept/show.html.twig', array(
            'recept' => $recept,
            'link'=> "recepten"
        ));
    }

    }