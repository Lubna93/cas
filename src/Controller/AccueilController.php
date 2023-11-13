<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class AccueilController extends AbstractController
{

    #[Route('/accueil', name: 'app_accueil')]
    public function index(

        ): Response
    {



        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
        

    }

    #[Route('/logout', name: 'app_logout')]

    public function logoutAction() {
        if (($this->getParameter('cas_logout_target') !== null) && (!empty($this->getParameter('cas_logout_target')))) {
            \phpCAS::logoutWithRedirectService($this->getParameter('cas_logout_target'));
        } else {
            \phpCAS::logout();
        }
    }


    #[Route('/login', name: 'login')]
    public function login(Request $request) {
        $url = 'https://'.$this->getParameter('cas_host') . $this->getParameter('cas_path') . '/login?service=';
        $target = $this->getParameter('cas_login_target');
        return $this->redirect($url . urlencode($target . '/force'));
    }

 
    #[Route('/force', name: 'force')]
    public function force(Request $request) {

         if ($this->getParameter('cas_gateway')) {
             if (!isset($_SESSION)) {
                     session_start();
             }

             session_destroy();
         }

         return $this->redirect($this->generateUrl('app_accueil'));
    }

    
}



