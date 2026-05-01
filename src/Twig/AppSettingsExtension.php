<?php
// src/Twig/AppSettingsExtension.php
namespace App\Twig;

use App\Service\AppSettingsService;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class AppSettingsExtension extends AbstractExtension implements GlobalsInterface
{
    public function __construct(private AppSettingsService $settings) {}

    public function getGlobals(): array
    {
        return ['app_settings' => $this->settings->all()];
    }
}
