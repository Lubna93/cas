<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use App\Repository\UserRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;


class DashboardController extends AbstractDashboardController
{
    private ChartBuilderInterface $chartBuilder;
    public function __construct(
        UserRepository $userRepository)
        {
            $this->userRepository = $userRepository;
        }
    

    public function apiAction(){
        $response = new Response();
        $date = new \DateTime();
    
        $response->setContent(json_encode([
            'id' => uniqid(),
            'time' => $date->format("Y-m-d")
        ]));
    
        $response->headers->set('Content-Type', 'application/json');
        // Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        
        return $response;
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addWebpackEncoreEntry('admin');
    }

    #[Route('/admin', name: 'admin')]

    public function index(ChartBuilderInterface $chartBuilder = null): Response
    {   
        assert(null !== $chartBuilder);

        $latestUsers = $this->userRepository->findLatest();

        return $this->render('admin/index.html.twig', [
            'latestUsers' => $latestUsers,
            // 'user' => $user,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BLAST Projet');
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->setDefaultSort(
                ['id'=> 'DESC',]
                );
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
    
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::linkToUrl('Formulaire d’adhésion', 'fas fa-file', '/user');
        yield MenuItem::linkToUrl('Le site', 'fa fa-laptop-code', '/');

        yield MenuItem::section('Administrateurs', 'fas fa-users');

        yield MenuItem::subMenu('User', 'fas fa-list-ul ms-2')->setSubItems([
            MenuItem::linkToCrud('Créer', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Afficher', 'fas fa-eye', User::class)
        ]);
    }

    #[Route('/admin/login')]
    public function adminLogin()
    {
        return $this->redirect('/login');
    }
    
    /**
     * @param UserInterface|User $user
     */
    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            // ->setAvatarUrl($user->getAvatarUrl())
            ->setName($user->getUsername())
            ;
    }



}
