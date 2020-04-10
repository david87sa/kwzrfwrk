<?php

namespace Kweizar\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $component = $this->getDoctrine()
                ->getRepository('KweizarPageBundle:MainComponent')
                ->findAll();
        return $this->render('KweizarStoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
