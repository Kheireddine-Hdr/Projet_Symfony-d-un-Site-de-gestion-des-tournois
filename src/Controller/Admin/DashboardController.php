<?php

namespace App\Controller\Admin;

use App\Entity\Club;
use App\Entity\User;
use App\Entity\Tours;
use App\Entity\Equipe;
use App\Entity\Groupe;
use App\Entity\Joueur;
use App\Entity\Tournoi;
use App\Entity\Evenement;
use App\Entity\MatchJouer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('TournoiProject');
    }
    public function configureMenuItems(): iterable
    {
        //yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Tournois', 'fas fa-list', Tournoi::class); // crud
        yield MenuItem::linkToCrud('Evenements', 'fas fa-list', Evenement::class); // crud
        yield MenuItem::linkToCrud('Groupes', 'fas fa-list', Groupe::class); // crud
        yield MenuItem::linkToCrud('Equipes', 'fas fa-list', Equipe::class); // crud
        yield MenuItem::linkToCrud('Clubs', 'fas fa-list', Club::class); // crud
        yield MenuItem::linkToCrud('Joueurs', 'fas fa-list', Joueur::class); // crud
        yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class); // crud
        yield MenuItem::linkToCrud('Matchs', 'fas fa-list', MatchJouer::class); // crud
        yield MenuItem::linkToCrud('Tours', 'fas fa-list', Tours::class); // crud
    }
    
}
