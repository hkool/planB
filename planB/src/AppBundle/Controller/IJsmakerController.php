<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 23-5-2019
 * Time: 11:58
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * Laat een lijst zien van al het fruit
     *
     * @Route("/", name="user_index")
     *
     */
    public function indexAction()
    {
        return $this->render('user/home/index.html.twig', array(
            'link'=> "home"
        ));
    }

}