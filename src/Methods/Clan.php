<?php

namespace Warface\Methods;

use Warface\Client;

class Clan
{
    private Client $controller;

    /**
     * User constructor.
     * @param Client $controller
     */
    public function __construct(Client $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @param string $clan
     * @return array
     */
    public function members(string $clan): array
    {
        return $this->controller->request('clan/members', [
            'clan' => $clan
        ]);
    }
}