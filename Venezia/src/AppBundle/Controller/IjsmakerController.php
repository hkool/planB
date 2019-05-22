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

class IjsmakerController extends Controller
{

    /**
     * @Route("/ijsmaker/listbestelling/", name="ijsmakerDefault")
     */
    public function defaultAction()
    {
        $this->denyAccessUnlessGranted('ROLE_IJSMAKER', null, 'U heeft geen toegang tot deze pagina!');
        $bestellingen = $this->getDoctrine()->getRepository(Bestelling::class)->findAll();
        return $this->render("ijsmaker/default.html.twig",
            [
                'bestellingen'=>$bestellingen,
                'link'=>'home'
            ]);
    }

}