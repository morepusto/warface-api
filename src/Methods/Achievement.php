<?php

declare(strict_types=1);

namespace Warface\Methods;

use Warface\Client;

class Achievement
{
    private Client $controller;

    /**
     * Achievement constructor.
     *
     * @param Client $controller
     */
    public function __construct(Client $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Gets a catalog of game achievements.
     *
     * @param int $variant
     * @return array
     */
    public function catalog(int $variant = 1): array
    {
        $get = [];

        switch ($variant)
        {
            case 1:
                $get = $this->controller->request('achievement/catalog');
                break;

            case 2:
                // TODO: Implementing an alternative way to get game achievements
                break;
        }

        return $get;
    }
}
