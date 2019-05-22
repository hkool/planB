<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fruit;
use AppBundle\Entity\Recept;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fruit controller.
 *
 * @Route("admin")
 */
class AdminController extends Controller
{
    /**
     * Laat een lijst zien van al het fruit
     *
     * @Route("/fruit/", name="admin_indexfruit")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fruits = $em->getRepository('AppBundle:Fruit')->findAll();

        return $this->render('admin/fruit/index.html.twig', array(
            'fruits' => $fruits,
        ));
    }

    /**
     * Maakt een entity fruit aan
     *
     * @Route("/fruit/new", name="admin_newfruit")
     * @Method({"GET", "POST"})
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
        ));
    }

    /**
     * Zoekt en toont een entity fruit
     *
     * @Route("/fruit/show/{id}", name="admin_showfruit")
     * @Method("GET")
     */
    public function showFruitAction(Fruit $fruit)
    {

        return $this->render('admin/fruit/show.html.twig', array(
            'fruit' => $fruit,
        ));
    }

    /**
     * Toont een form om een fruit entity te updaten
     *
     * @Route("/fruit/edit/{id}", name="admin_editfruit")
     * @Method({"GET", "POST"})
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

        ));
    }

    /**
     * verwijdert een entity fruit
     *
     * @Route("/delete/fruit/{id}", name="admin_deletefruit")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
            $em = $this->getDoctrine()->getManager();
            $fruit= $em->getRepository(Fruit::class)->find($id);
            $em->remove($fruit);
            $em->flush();
        return $this->redirectToRoute('admin_indexfruit');
    }


    /**
     * Lists all recept entities.
     *
     * @Route("/recepten", name="admin_indexrecept")
     * @Method("GET")
     */
    public function indexReceptAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recepts = $em->getRepository('AppBundle:Recept')->findAll();

        return $this->render('admin/recept/index.html.twig', array(
            'recepts' => $recepts,
        ));
    }

    /**
     * Creates a new recept entity.
     *
     * @Route("/recept/new", name="admin_newrecept")
     * @Method({"GET", "POST"})
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
        ));
    }

    /**
     * Finds and displays a recept entity.
     *
     * @Route("/recept/show/{id}", name="admin_showrecept")
     * @Method("GET")
     */
    public function showReceptAction(Recept $recept)
    {


        return $this->render('admin/recept/show.html.twig', array(
            'recept' => $recept,

        ));
    }

    /**
     * Displays a form to edit an existing recept entity.
     *
     * @Route("/recept/edit/{id}", name="admin_editrecept")
     * @Method({"GET", "POST"})
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
        ));
    }

    /**
     * Deletes a recept entity.
     *
     * @Route("/recept/delete/{id}", name="admin_deleterecept")
     * @Method("DELETE")
     */
    public function deleteReceptAction(Request $request, $id)
    {

            $em = $this->getDoctrine()->getManager();
            $recept = $em->getRepository(Recept::class)->find($id);
            $em->remove($recept);
            $em->flush();


        return $this->redirectToRoute('admin_indexrecept');
    }


}
