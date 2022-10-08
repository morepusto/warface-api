<?php

declare(strict_types=1);

namespace Warface\Methods;

use Warface\Interfaces\MethodInterface as Client;
use Warface\Interfaces\Methods\AchievementInterface;

class Achievement implements AchievementInterface
{
    private Client $controller;

    /**
     * @param Client $controller
     */
    public function __construct(Client $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @param int $variant
     * @return array
     */
    public function catalog(int $variant = self::CATALOG_DEFAULT_TYPE): array
    {
        $get = [];

        switch ($variant)
        {
            case self::CATALOG_DEFAULT_TYPE:
                $get = $this->controller->request('achievement/catalog');
                break;

            case self::CATALOG_ALTERNATIVE_TYPE:
                // TODO: Implementing an alternative way to get game achievements
                break;
        }

        return $get;
    }
}
