<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\WsApogeeBundle\DependencyInjection\EtatIA;
use App\WsApogeeBundle\DependencyInjection\WsAdministratif;
use App\Entity\User;
use L3\Bundle\LdapUserBundle\Entity\LdapUser;
use App\Form\UserFormType;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

class UserController extends AbstractController
{
    public function __construct(
        UserRepository $userRepository)
        {
            $this->userRepository = $userRepository;
        }


    #[Route('/user', name: 'app_user')]

    public function index(WsAdministratif $ws, UserRepository $userRepository, ManagerRegistry $doctrine, Request $request, MailerInterface $mailer): Response
    {
        $ws->setFastResponse(true);

        $user = $userRepository->findAll();

        $user = $this->userRepository
        ->findAll();       

        $user = new user();
        
        $utilisateur = $this->get('security.token_storage')->getToken()->getUser();
        $utilisateur->getUsername();

        $form = $this->createForm(UserFormType::class, $user, [
            'action' => $this->generateUrl('app_user')
        ]);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) { 
            $em = $doctrine -> getManager();
            $em -> persist($user);
            $em -> flush();

            //success message
            $this-> addFlash('success', 'Votre réponse a été enregistrée !');
            $this->addFlash('info', 'Some useful info');

            $email = (new Email())
                ->from('lubna.akash@univ-montp3.fr')
                ->to(new Address('lubna.akash@univ-montp3.fr'))
                ->subject('You got mail!')
                ->text('Sending emails is fun again!')
                ->html('<p>See Twig integration for better HTML integration!</p>');

            $mailer->send($email);

            return $this->redirectToRoute('app_profile_show');  
        }

        return $this->render('user/index.html.twig', [
            'user_form' => $form->createView(),
            'user' => $user,
            'controller_name' => 'Formulaire d’adhésion',
            'iaAnnuellesV2' => $ws->recupererIAAnnuelles_v2($utilisateur),
            'iaEtapesV3' =>$ws->recupererIAEtapes_v3($utilisateur),
        ]);
    }

}