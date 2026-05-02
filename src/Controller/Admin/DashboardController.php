<?php

namespace App\Controller\Admin;

use App\Service\AppSettingsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    public function __construct(
        private AppSettingsService $settings
    ){}

    #[Route('/admin/dashboard', name: 'app_admin_dashboard_index')]
    public function index(): Response
    {
        return $this->render('admin/dashboard/index.html.twig', []);
    }

    #[Route('/admin/dashboard/aside', name: 'app_admin_dashboard_settings')]
    public function settings(): Response
    {
        $application = $this->settings->get('application');

        return $this->render('composants/admin/sidebar.html.twig', [
            'application' => $application,
        ]);
    }
}
