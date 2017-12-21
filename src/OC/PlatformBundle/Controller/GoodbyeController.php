<?php

// src/OCPlatformBundle/Controller/GoodbyeController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GoodbyeController extends Controller 
{
    public function indexAction() {

        $content = $this
            ->get('templating')
            ->render('OCPlatformBundle:Goodbye:index.html.twig', array('nom'=>'Yasmichel'));

        return new Response($content);

    }
}
