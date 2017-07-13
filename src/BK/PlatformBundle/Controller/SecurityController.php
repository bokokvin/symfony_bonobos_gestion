<?php

namespace BK\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
  public function loginAction(Request $request)
  {
    
    if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
      return $this->redirect($this->generateUrl('bk_platform_homepage'));
	 // return $this->render('BKPlatformBundle::accueil.html.twig');
    }
    
    $authenticationUtils = $this->get('security.authentication_utils');

    return $this->render('BKPlatformBundle::login.html.twig', array(
      'last_username' => $authenticationUtils->getLastUsername(),
      'error'         => $authenticationUtils->getLastAuthenticationError(),
    ));
  }
}