<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/front/page', name: 'app_front_page')]
    public function index(): Response
    {
        return $this->render('front/page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/', name: 'app_front_page_maintenance')]
    public function Maintenance(): Response
    {
        return $this->render('front/page/maintenance.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
