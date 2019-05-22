<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 4-4-2019
 * Time: 12:50
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Bestelling;
use AppBundle\Entity\Bestelregel;
use AppBundle\Entity\Fruit;
use AppBundle\Entity\Recept;
use AppBundle\Entity\Receptregel;
use AppBundle\Form\BestellingType;
use AppBundle\Form\BestellingTypeA;
use AppBundle\Form\BestelregelType;
use AppBundle\Form\FruitType;
use AppBundle\Form\ReceptregelType;
use AppBundle\Form\ReceptType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{

    /**
     * @Route("/admin/", name="adminDefault")
     */
    public function defaultAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'U heeft geen toegang tot deze pagina!');
        $ijssoorten = $this->getDoctrine()->getRepository(Recept::class)->findAll();
        return $this->render("admin/default.html.twig",
            [
                'ijssoorten'=>$ijssoorten,
                'hoeveelheidsoorten'=>count($ijssoorten),
                'link'=>'home'
            ]);
    }
    /**
     * @Route("/admin/adddrecept/", name="adminAddRecept")
     */
    public function addReceptAction(Request $request)
    {
        $recept = new Recept();
        $form = $this->createForm(ReceptType::class, $recept);
        $form->handleRequest($request);
        if($form->isSubmitted() AND $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recept);
            $em->flush();
            return $this->redirectToRoute('adminDefault');
        }
        return $this->render('admin/crudRecept.html.twig',
            [
                'form'=>$form->createView(),
                'link'=>'recept'
            ]);
    }
    /**
     * @Route("/admin/updaterecept/{id}", name="adminUpdateRecept")
     */
    public function updateReceptAction(Request $request, $id)
    {
        $recept = $this->getDoctrine()->getRepository(Recept::class)->find($id);
        $form = $this->createForm(ReceptType::class, $recept);
        $form->handleRequest($request);
        if($form->isSubmitted() AND $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recept);
            $em->flush();
            return $this->redirectToRoute('adminDefault');
        }
        return $this->render('admin/crudRecept.html.twig',
            [
                'form'=>$form->createView(),
                'link'=>'recept'
            ]);
    }
    /**
     * @Route("/admin/deleterecept/{id}", name="adminDeleteRecept")
     */
    public function deleteeReceptAction(Request $request, $id)
    {
        $recept = $this->getDoctrine()->getRepository(Recept::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        if ($recept != null){
            $em->remove($recept);
            $em->flush();
        }
//        $form = $this->createForm(ReceptType::class, $recept);
//        $form->handleRequest($request);
//        if($form->isSubmitted() AND $form->isValid())
//        {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($recept);
//            $em->flush();
//            return $this->redirectToRoute('adminDefault');
//        }
//        return $this->render('admin/crudRecept.html.twig',
//            [
//                'form'=>$form->createView()
//            ]);
    }
    /**
     * @Route("/admin/addfruit/", name="adminAddFruit")
     */
    public function addFruitAction(Request $request)
    {
        $fruit = new Fruit();
        $form = $this->createForm(FruitType::class, $fruit);
        $form->handleRequest($request);
        if($form->isSubmitted() AND $form->isValid())
        {
            $fruit = $form->getData();
            $filename = $this->saveFile($fruit);
            $fruit->setImage($filename);
            $em = $this->getDoctrine()->getManager();
            $em->persist($fruit);
            $em->flush();
            return $this->redirectToRoute('adminDefault');
        }
        return $this->render('admin/crudFruit.html.twig',
            [
                'form'=>$form->createView(),
                'link'=>'fruit'
            ]);
    }

    /**
     * @Route("/admin/updatefruit/{id}", name="adminUpdateFruit")
     */
    public function updateFruitAction(Request $request,$id)
    {
        $fruit = $this->getDoctrine()->getRepository(Fruit::class)->find($id);
        try{
            $fruit->setImage(new File($this->getParameter('image_directory').'/'.$fruit->getImage()));
        }
        catch(FileException $fe)
        {
            $fruit->setImage(null);
        }
        $form = $this->createForm(FruitType::class, $fruit);
        $form->handleRequest($request);
        if($form->isSubmitted() AND $form->isValid())
        {
            $filename = $this->saveFile($fruit);
            $fruit->setImage($filename);
            $em = $this->getDoctrine()->getManager();
            $em->persist($fruit);
            $em->flush();
            return $this->redirectToRoute('adminListFruit');
        }
        return $this->render('admin/crudFruit.html.twig',
            [
                'form'=>$form->createView(),
                'link'=>'fruit'
            ]);
    }
    /**
     * @Route("/admin/listrecepten/", name="adminListRecepten")
     */
    public function listReceptenAction()
    {
        $recepten = $this->getDoctrine()->getRepository(Recept::class)->findAll();
        return $this->render('admin/recepten.html.twig',[
            'recepten'=>$recepten,
            'link'=>'recept'
        ]);
    }
    /**
     * @Route("/admin/listfruit/", name="adminListFruit")
     */
    public function listFruitAction()
    {
        $fruitsoorten = $this->getDoctrine()->getRepository(Fruit::class)->findAll();
        return $this->render('admin/fruit.html.twig',[
            'fruitsoorten'=>$fruitsoorten,
            'link'=>'fruit'
        ]);
    }
//    /**
//     * @Route("/admin/addbestelling", name="adminAddBestelling")
//     */
//    public function addBestellingAction(Request $request)
//    {
//        $bestelling = new Bestelling();
//        $bestelregel = new Bestelregel();
//        $bestelling->getBestelregels()->add($bestelregel);
////        $bestelregel1 = new Bestelregel();
////        $bestelling->getBestelregels()->add($bestelregel1);
//        $form = $this->createForm(BestellingType::class, $bestelling);
//        $form->handleRequest($request);
//        if($form->isSubmitted() AND $form->isValid()) {
//            $bestelling = $form->getData();
//            $bestelregels = $form->get('bestelregels')->getData();
//            $em = $this->getDoctrine()->getManager();
//            foreach ($bestelregels as $br) {
//                $br->setBestelling($bestelling);
//                $em->persist($br);
//                $em->flush();
//            }
//
////            $em->merge($bestelling);
////            $em->flush();
//
//           return $this->redirectToRoute('adminListBestellingen');
//        }
//        return $this->render('admin/crudBestellingA.html.twig',
//            [
//                'form'=>$form->createView(),
//                'link'=>'bestelling'
//            ]);
//
//    }
    /**
     * @Route("/admin/addbestellinga/", name="adminAddBestellingA")
     */
    public function addBestellingAAction(Request $request)
    {
        $bestelling = new Bestelling();
        $form = $this->createForm(BestellingTypeA::class, $bestelling);
        $form->handleRequest($request);
        if($form->isSubmitted() AND $form->isValid()) {
            $bestelling = $form->getData();
            $em = $this->getDoctrine()->getManager();
        $em->persist($bestelling);
        $em->flush();
            return $this->redirectToRoute('adminAddBestelregel',array('id'=>$bestelling->getId()));
        }
        return $this->render('admin/crudBestellingA.html.twig',
            [
                'form'=>$form->createView(),
                'link'=>'bestelling'
            ]);

    }
    /**
     * @Route("/admin/addbestelregel/{id}", name="adminAddBestelregel")
     */
    public function addBestelregelAction(Request $request,$id)
    {
        $bestelling=$this->getDoctrine()->getRepository(Bestelling::class)->find($id);
        $bestelregel = new Bestelregel();
        $bestelregel->setBestelling($bestelling);
        $form = $this->createForm(BestelregelType::class, $bestelregel);
        $form->handleRequest($request);
        if($form->isSubmitted() AND $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bestelregel);
            $em->flush();
            return $this->redirectToRoute('adminAddBestelregel',array('id'=>$bestelling->getId()));
        }
        return $this->render('admin/crudBestelregel.html.twig',
            [
                'form'=>$form->createView(),
                'link'=>'bestelling',
                'bestelling'=>$bestelling
            ]);

    }
    /**
     * @Route("/admin/listbestelling", name="adminListBestellingen")
     */
    public function listBestellingenAction()
    {
        $bestellingen = $this->getDoctrine()->getRepository(Bestelling::class)->findAll();
        return $this->render('admin/default.html.twig',[
            'bestellingen'=>$bestellingen,
            'link'=>'bestelling'

        ]);
    }
    /**
     * @Route("/admin/updatebestelling/{id}", name="adminUpdateBestelling")
     */
    public function updateBestellingAction(Request $request, $id)
    {
        $bestelling = $this->getDoctrine()->getRepository(Bestelling::class)->find($id);
        $form = $this->createForm(BestellingType::class, $bestelling);
        $form->handleRequest($request);
        if($form->isSubmitted() AND $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bestelling);
            $em->flush();
            return $this->redirectToRoute('adminDefault');
        }
        return $this->render('admin/crudBestelling.html.twig',
            [
                'form'=>$form->createView(),
                'link'=>'bestelling'
            ]);
    }



    private function saveFile($entity)
    {
        $file=$entity->getImage();
        $fileName=$this->generateUniqueFileName().'.'.$file->guessExtension();
        try {
            $file->move(
                $this->getParameter('image_directory'),
                $fileName
            );
        } catch(FileException $e)
        {
            $this->addFlash('notice','Opslaan foto is niet gelukt.');
            $this->redirectToRoute('adminAddFruit');
        }
        return $fileName;
    }
    private function generateUniqueFileName()
    {
        /* uniqid geeft een random getal gebaseerd op timestamps
        md5 versleuteld die om overeenkomstige namen te voorkomen
        */
        return md5(uniqid());
    }


}