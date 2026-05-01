<?php

namespace App\Controller\Front;

use App\Service\AppSettingsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    public function __construct(
        private AppSettingsService $settings)
    {}

    #[Route('/', name: 'app_front_page_home')]
    public function home(): Response
    {
        return $this->render('front/page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
