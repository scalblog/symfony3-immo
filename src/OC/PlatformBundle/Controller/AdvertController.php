<?php
// src/OC/PlatformBundle/Controller/AdvertController.php
namespace OC\PlatformBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class AdvertController extends Controller
{
  public function indexAction($page)
  {
    // On ne sait pas combien de pages il y a
    // Mais on sait qu'une page doit être supérieure ou égale à 1
    if ($page < 1) {
      // On déclenche une exception NotFoundHttpException, cela va afficher
      // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
      throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
    }

    $listAdverts =  array(
      array(
        'title'=>'Recherche Développeur Symfony 3',
        'id'=>1,
        'author'=>'Alexandre',
        'content'=>'Pour un poste sur Lyon',
        'date'=> new \Datetime()
      ),
      array(
        'title'=>'Mission pour super Webmaster',
        'id'=>2,
        'author'=>'Victor',
        'content'=>'Nous recherchons un Webmaster qui sera super cool et très performant',
        'date'=> new \Datetime()
      ),
      array(
        'title'=>'Offre de stage tout pourri',
        'id'=>3,
        'author'=>'Yaelle',
        'content'=>'Me demandez pas les détails, c est à Courbevoie',
        'date'=> new \Datetime()
      )



    );
    // Ici, on récupérera la liste des annonces, puis on la passera au template
    // Mais pour l'instant, on ne fait qu'appeler le template
    return $this->render('OCPlatformBundle:Advert:index.html.twig', array ('listAdverts'=>$listAdverts));
  }

  public function menuAction($limit){
    $listAdverts = array(
        array("id"=>2, "title"=>'Recherche développeur Symfony'),
        array("id"=>5, "title"=> 'Mission de webmaster'),
        array("id"=>9, "title"=> 'Offre de stage de webdesign')
    );
    return $this->render('OCPlatformBundle:Advert:menu.html.twig', array('listAdverts' =>$listAdverts));

  }

  public function viewAction($id)
  {

    $advert=array(
      'title'=>'Recherchons développeur Symfony virtuose',
      'id'=>$id,
      'author'=>'Alexandre',
      'content'=>'C est sur Lyon que ça se passe mais sinon le reste c est super.',
      'date'=> new \Datetime()
    );
    // Ici, on récupérera l'annonce correspondante à l'id $id
    return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
      'advert' => $advert
    ));
  }
  public function addAction(Request $request)
  {
    // La gestion d'un formulaire est particulière, mais l'idée est la suivante :
    // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
    if ($request->isMethod('POST')) {
      // Ici, on s'occupera de la création et de la gestion du formulaire
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
      // Puis on redirige vers la page de visualisation de cettte annonce
      return $this->redirectToRoute('oc_platform_view', array('id' => 5));
    }
    // Si on n'est pas en POST, alors on affiche le formulaire
    return $this->render('OCPlatformBundle:Advert:add.html.twig');
  }
  public function editAction($id, Request $request)
  {
    // Ici, on récupérera l'annonce correspondante à $id
    // Même mécanisme que pour l'ajout
    if ($request->isMethod('POST')) {
      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
      return $this->redirectToRoute('oc_platform_view', array('id' => 5));
    }

    $advert=array(
      'title'=>'Recherche active de développeur Symfony',
      'id'=>$id,
      'author'=>'Alexandre',
      'content'=>'Nous recherchons un développeur Synfony sur Lyon.',
      'date'=> new \Datetime()
    );
    return $this->render('OCPlatformBundle:Advert:edit.html.twig', array('advert'=>$advert));
  }
  public function deleteAction($id)
  {
    // Ici, on récupérera l'annonce correspondant à $id
    // Ici, on gérera la suppression de l'annonce en question
    return $this->render('OCPlatformBundle:Advert:delete.html.twig');
  }
}