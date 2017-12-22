<?php

// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller 
{
    //La route fait appel à OCPlatformBundle:Advert:view,
    //on doit donc définir la méthode viewAction.
    //On donne à cette méthode l'argument $id, pour
    //correspondre au paramètre {id} de la route.

    public function viewAction($id){
        // $id vaut 5 si on appelle l'URL platform/advert/5
        // Ici on récupérera depuis la base de données
        // l annonce correspondante à l id $id
        // Puis on passera l'annonce à la vue pour
        // qu'elle l affiche

        return new Response("Affichage de l'annonce d'id : ".$id);
    }

    public function viewSlugAction($slug, $year, $format){
        return new Response("
            On pourrait afficher l'annonce correspondant au slug '".$slug."', créée en ".$year." et au format ".$format."."
        );
    }

    public function indexAction() {
        $content = $this
            ->get('templating')
            ->render('OCPlatformBundle:Advert:index.html.twig', array('nom'=>'winzou'));
        
        return new Response($content);
    }
}