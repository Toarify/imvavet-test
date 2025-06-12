<?php

namespace App\Controller\Admin;

use App\Entity\About;
use App\Entity\User;
use App\Entity\Article;
use App\Entity\Vaccine;
use App\Entity\ArticleImage;
use App\Entity\VaccineImage;
use App\Entity\ArticleDetails;
use App\Entity\Vaccine2;
use App\Entity\VaccineDetails;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
     #[Route('/admin', name: 'admin')]
    // #[IsGranted('ROLE_SUPER_ADMIN')]
    // #[IsGranted('ROLE_ADMIN')]

    public function index(): Response
    {
        //   if (!$this->isGranted('ROLE_ADMIN')) {
        //       throw new AccessDeniedHttpException('Accès refusé : Vous devez être administrateur pour accéder à cette page.');
        //   }

        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ArticleCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admninistration imvavet');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Acceuil', 'fa fa-home', 'app_home');

        // Vérifie si l'utilisateur a le rôle ROLE_SUPER_ADMIN
        // if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            yield MenuItem::linkToCrud('Users', 'fa fa-user',User::class);
        // }

        // Menu Parent "Article"
        yield MenuItem::subMenu('A propos', 'fas fa-circle')->setSubItems([
            MenuItem::linkToCrud('Entete', 'fas fa-info', About::class),
        ]);


        // Menu Parent "Article"
        yield MenuItem::subMenu('Article', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Tout Article', 'fas fa-newspaper', Article::class),
            // MenuItem::linkToCrud('Article image', 'fas fa-list', ArticleImage::class),
            MenuItem::linkToCrud('Détails des Articles', 'fas fa-info-circle', ArticleDetails::class),
        ]);

        // Menu Parent "Vaccine"
        yield MenuItem::subMenu('Vaccine', 'fas fa-syringe')->setSubItems([
            MenuItem::linkToCrud('Tous les vaccins', 'fas fa-syringe', Vaccine::class),
            // MenuItem::linkToCrud('Vaccine image', 'fas fa-list', VaccineImage::class),
            MenuItem::linkToCrud('Détails des vaccins', 'fas fa-info-circle', VaccineDetails::class),
           // MenuItem::linkToCrud('Vaccin2', 'fas fa-syringe', Vaccine2::class),
        ]);

    }
    
    public function configureAssets(): Assets
    {
        $assets = Assets::new();
        $assets->addAssetMapperEntry('quill-admin');
        return $assets;
    }
    
}
