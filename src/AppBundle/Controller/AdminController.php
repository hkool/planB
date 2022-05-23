<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bestelling;
use AppBundle\Entity\Fruit;
use AppBundle\Entity\Recept;
use AppBundle\Form\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Admin controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
    /**
     * laat de homepage van de admin zien
     *
     * @Route("/", name="admin_index")
     *
     */
    public function indexAction()
    {
        return $this->render('admin/index.html.twig', array(
            'link' => 'home'
        ));
    }
    //----------------------------begin crud fruit--------------------------------------------------------
    /**
     * Laat een lijst zien van al het fruit
     *
     * @Route("/fruit/", name="admin_indexfruit")
     *
     */
    public function indexfruitAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fruits = $em->getRepository('AppBundle:Fruit')->findAll();

        return $this->render('admin/fruit/index.html.twig', array(
            'fruits' => $fruits,
            'link'=> "fruit"
        ));
    }


    /**
     * Maakt een entity fruit aan
     *
     * @Route("/fruit/new", name="admin_newfruit")
     *
     */
    public function newAction(Request $request)
    {
        $fruit = new Fruit();
        $form = $this->createForm('AppBundle\Form\FruitType', $fruit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fruit);
            $em->flush();

            return $this->redirectToRoute('admin_indexfruit');
        }

        return $this->render('admin/fruit/new.html.twig', array(
            'fruit' => $fruit,
            'form' => $form->createView(),
            'link'=> "fruit"
        ));
    }

    /**
     * Zoekt en toont een entity fruit
     *
     * @Route("/fruit/show/{id}", name="admin_showfruit")
     *
     */
    public function showFruitAction(Fruit $fruit)
    {

        return $this->render('admin/fruit/show.html.twig', array(
            'fruit' => $fruit,
            'link'=> "fruit"
        ));
    }

    /**
     * Toont een form om een fruit entity te updaten
     *
     * @Route("/fruit/edit/{id}", name="admin_editfruit")
     *
     */
    public function editAction(Request $request, Fruit $fruit)
    {

        $editForm = $this->createForm('AppBundle\Form\FruitType', $fruit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_indexfruit', array('id' => $fruit->getId()));
        }

        return $this->render('admin/fruit/edit.html.twig', array(
            'fruit' => $fruit,
            'edit_form' => $editForm->createView(),
            'link'=> "fruit"

        ));
    }

    /**
     * verwijdert een entity fruit
     *
     * @Route("/delete/fruit/{id}", name="admin_deletefruit")
     *
     */
    public function deleteAction(Request $request, $id)
    {
            $em = $this->getDoctrine()->getManager();
            $fruit= $em->getRepository(Fruit::class)->find($id);
            $em->remove($fruit);
            $em->flush();
        return $this->redirectToRoute('admin_indexfruit');
    }
    //--------------------------eind crud fruit --------------------------------------------------------
    //--------------------------begin crud recept -------------------------------------------------------

    /**
     * Lists all recept entities.
     *
     * @Route("/recepten", name="admin_indexrecept")
     *
     */
    public function indexReceptAction()
    { $em = $this->getDoctrine()->getManager();

        $recepts = $em->getRepository('AppBundle:Recept')->findAll();

        return $this->render('admin/recept/index.html.twig', array(
            'recepts' => $recepts,
            'link'=> "recepten"
        ));
    }

    /**
     * Creates a new recept entity.
     *
     * @Route("/recept/new", name="admin_newrecept")
     *
     */
    public function newReceptAction(Request $request)
    {
        $recept = new Recept();
        $form = $this->createForm('AppBundle\Form\ReceptType', $recept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recept);
            $em->flush();

            return $this->redirectToRoute('admin_showrecept', array('id' => $recept->getId()));
        }

        return $this->render('admin/recept/new.html.twig', array(
            'recept' => $recept,
            'form' => $form->createView(),
            'link'=> "recepten"
        ));
    }

    /**
     * Finds and displays a recept entity.
     *
     * @Route("/recept/show/{id}", name="admin_showrecept")
     *
     */
    public function showReceptAction(Recept $recept)
    {


        return $this->render('admin/recept/show.html.twig', array(
            'recept' => $recept,
            'link'=> "recepten"
        ));
    }

    /**
     * Displays a form to edit an existing recept entity.
     *
     * @Route("/recept/edit/{id}", name="admin_editrecept")
     *
     */
    public function editReceptAction(Request $request, Recept $recept)
    {
        $editForm = $this->createForm('AppBundle\Form\ReceptType', $recept);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_editrecept', array('id' => $recept->getId()));
        }

        return $this->render('admin/recept/edit.html.twig', array(
            'recept' => $recept,
            'edit_form' => $editForm->createView(),
            'link'=> "recepten"
        ));
    }

    /**
     * Deletes a recept entity.
     *
     * @Route("/recept/delete/{id}", name="admin_deleterecept")
     *
     */
    public function deleteReceptAction(Request $request, $id)
    {
            $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'U kunt deze opdracht niet laten uitvoeren omdat u de rechten niet heeft!');
            $em = $this->getDoctrine()->getManager();
            $recept = $em->getRepository(Recept::class)->find($id);
            $em->remove($recept);
            $em->flush();


        return $this->redirectToRoute('admin_indexrecept');
}   ///---------------------------eind crud recept ----------------------------------------------------
/// //----------------------------begin bestelling ------------------------------------------------
    /**
     * Creates a new recept entity.
     *
     * @Route("/bestelling/new", name="admin_newbestelling")
     *
     */
    public function newBestellingAction(Request $request)
    {
        $bestelling = new Bestelling();
        $form = $this->createForm('AppBundle\Form\BestellingType', $bestelling);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bestelling);
            $em->flush();

            return $this->redirectToRoute('admin_showbestelling', array('id' => $bestelling->getId()));
        }

        return $this->render('admin/bestelling/new.html.twig', array(
            'bestelling' => $bestelling,
            'form' => $form->createView(),
            'link'=> "bestellingen"
        ));
    }
    //-------------------------------- eind bestelling ----------------------------------------
    // -------------------------------reset wachtwoord medewerkers -----------------------------
    /**
     * @Route("/resetwww/",name="resetWachtwoord")
     */
    function resetWachtwoordAction (Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['username'=>'ijsmaker']);

        $passwordEncoder = $this->get('security.password_encoder');
        $plainPassword = "qwerty";

        $newEncodedPassword = $passwordEncoder->encodePassword($user, $plainPassword);
        $user->setPassword($newEncodedPassword);
        try{
                $em->persist($user);
                $em->flush();

                $this->addFlash('notice', 'Uw wachtwoord is gewijzigd, u kunt inloggen met het standaard wachtwoord en dat direct veranderen!');
        }
        catch(\Exception $e)
        {
            $this->addFlash('warning','Reset wachtwoord niet gelukt. Raadpleeg de beheerder.');
        }
        return $this->redirectToRoute('ijsmaker_index');
    }



}
