<?php

namespace App\Service;

use Symfony\Component\Yaml\Yaml;

class AppSettingsService
{
    private array $settings;

    public function __construct(string $projectDir)
    {
        $this->settings = Yaml::parseFile($projectDir . '/config/app_settings.yaml');
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $keys = explode('.', $key);
        $value = $this->settings['app'] ?? [];

        foreach ($keys as $k) {
            if (!isset($value[$k])) return $default;
            $value = $value[$k];
        }

        return $value;
    }

    public function all(): array
    {
        return $this->settings['app'] ?? [];
    }

    public function getSite(): array
    {
        return $this->settings['app']['site'] ?? [];
    }
}
