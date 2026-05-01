<?php
// src/EventListener/MaintenanceListener.php
namespace App\EventListener;

use App\Service\AppSettingsService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;

class MaintenanceListener
{
    public function __construct(
        private AppSettingsService $settings,
        private Environment $twig
    ) {}

    public function onKernelRequest(RequestEvent $event): void
    {
        // On ne traite que la requête principale (pas les sous-requêtes)
        if (!$event->isMainRequest()) {
            return;
        }

        $path = $event->getRequest()->getPathInfo();

        // Exclure la toolbar et le profiler Symfony
        if (str_starts_with($path, '/_wdt') || str_starts_with($path, '/_profiler')) {
            return;
        }

        $route = $event->getRequest()->attributes->get('_route');

        if (str_starts_with($route ?? '', 'app_admin_')) {
            return;
        }

        if ((bool) $this->settings->get('site_offline')) {
            $html = $this->twig->render('front/page/maintenance.html.twig', [
                'site_name'    => $this->settings->get('site_name'),
                'title'        => $this->settings->get('maintenance.offline_title'),
                'message'      => $this->settings->get('maintenance.offline_message'),
                'logo'         => $this->settings->get('logo'),
            ]);

            $event->setResponse(new Response($html, Response::HTTP_SERVICE_UNAVAILABLE));
        }
    }
}
