<?php

namespace BK\PlatformBundle\Controller;

use BK\PlatformBundle\Entity\Ami;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;


class AmiController extends Controller
{
	public function HomeAction()
    {	
		
			return $this->render('BKPlatformBundle::accueil.html.twig');
    }
	
	public function InscriptionAction()
    {	
		
			return $this->render('BKPlatformBundle::inscription.html.twig');
    }
	
	public function AjoutUserAction(Request $request)
    {	
		$gestion = new Ami();
		$i=1;
		
		$em = $this->getDoctrine()->getManager();
		
		if ($request->isMethod('POST')) 
		{
			$gestion->setLogin($request->get('_login'));
			$gestion->setPassword($request->get('_password'));
			$gestion->setAge($request->get('_age'));
			$gestion->setRace($request->get('_race'));
			$gestion->setNourriture($request->get('_nourriture'));
			$gestion->setFamille($request->get('_famille'));
			$em->persist($gestion);
			$em->flush();
					
			return $this->redirect($this->generateUrl('login'));
		}
		
		return $this->render('BKPlatformBundle::accueil.html.twig');
    }
	
    public function ListerAction()
    {
		$i=1;
		$tab=array();
		$repository = $this
	        ->getDoctrine()
			->getManager()
			->getRepository('BKPlatformBundle:Ami');
        
		    $gestion = $repository->find($this->container->get('security.context')->getToken()->getUser());
			
			foreach ($gestion->getAmis() as $ggestion) 
			{
				$tab[$i]["id"]         = $ggestion->getId();
				$tab[$i]["login"]      = $ggestion->getLogin();
				$tab[$i]["age"]        = $ggestion->getAge();
				$tab[$i]["famille"]    = $ggestion->getFamille();
				$tab[$i]["race"]       = $ggestion->getRace();
				$tab[$i]["nourriture"] = $ggestion->getNourriture();
				
				$i++;
				
				
			}
			
		
		return $this->render('BKPlatformBundle:Default:liste.html.twig', array('gestion' => $tab) );
    }
	
	public function ModifierAction(Request $request)
    {
		
	$gestion = new Ami();
	
	$gestion = $this->getDoctrine()
		->getManager()
		->getRepository('BKPlatformBundle:Ami')
		->find($this->container->get('security.context')->getToken()->getUser());

    $form = $this->get('form.factory')->createBuilder('form', $gestion)
      ->add('login',      'text')
      ->add('password',     'text')
      ->add('age',   'text')
      ->add('famille',    'text')
      ->add('race', 'text')
      ->add('nourriture',      'text')
	  ->add('Annuler',      'reset')
	  ->add('Modifier',      'submit')
      ->getForm()
    ;

    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($gestion);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Modification enregistrée.');

     
      return $this->redirect($this->generateUrl('bk_platform_modification'));
    }


    return $this->render('BKPlatformBundle:Default:modifier.html.twig', array(
      'form' => $form->createView(),
    ));
    
    
	}
	
	
	public function ModificationAction()
    {
        $em = $this
	        ->getDoctrine()
			->getManager();
			
        $gestion = $em->getRepository('BKPlatformBundle:Ami')->find($this->container->get('security.context')->getToken()->getUser());
			
		$em->flush();
		
		return $this->render('BKPlatformBundle:Default:infos.html.twig', array('gestion' => $gestion) );
    }
	
	public function SupprimerAction($id)
    {
        
		$em = $this
	        ->getDoctrine()
			->getManager();
			
        $gestion = $em->getRepository('BKPlatformBundle:Ami')->find(1);
		$ami 	 = $em->getRepository('BKPlatformBundle:Ami')->find($id);
		
			
     	$gestion->removeAmi($ami);	
			
		$em->flush();
			
		return $this->redirect($this->generateUrl('bk_platform_lister'));
    }
	
	public function AjouterAction($id)
    {
	
		$em = $this
	        ->getDoctrine()
			->getManager();
			
        $gestion = $em->getRepository('BKPlatformBundle:Ami')->find($this->container->get('security.context')->getToken()->getUser());
		$ami 	 = $em->getRepository('BKPlatformBundle:Ami')->find($id);
		
			
     	$gestion->addAmi($ami);	
			
		$em->flush();
			
		return $this->redirect($this->generateUrl('bk_platform_lister'));
	}
	
	
	public function RechercherAction(Request $request)
    {	
		$i=1;
		$data = array();	
		$tab = array();
		$form = $this->createFormBuilder($data)
        ->add('login', 'text', array(
		'attr' => array('placeholder' => 'Recherchez par pseudo(login)')))
		->add('rechercher', 'submit')
		->getForm();

    if ($request->isMethod('POST')) 
	{
        $form->handleRequest($request);
		$data = $form->getData();		
		$ami  = $this->getDoctrine()->getManager()->getRepository('BKPlatformBundle:Ami')->findby($data);	
		
		foreach ($ami as $ggestion) 
			{
				$tab[$i]["id"]         = $ggestion->getId();
				$tab[$i]["login"]      = $ggestion->getLogin();
				$tab[$i]["age"]        = $ggestion->getAge();
				$tab[$i]["famille"]    = $ggestion->getFamille();
				$tab[$i]["race"]       = $ggestion->getRace();
				$tab[$i]["nourriture"] = $ggestion->getNourriture();
				
				$i++;				
			}
    }
    


	return $this->render('BKPlatformBundle:Default:recherche.html.twig', array(
      'form' => $form->createView(),
	  'gestion' => $tab
	  
    ));
    }
	
	
}