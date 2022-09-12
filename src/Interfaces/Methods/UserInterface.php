<?php

declare(strict_types=1);

namespace Warface\Interfaces\Methods;

use Warface\Helpers\FullResponse;

interface UserInterface
{
    /**
     * This method returns player statistics.
     *
     * @param string $name
     * @param int $formatFullResponse
     * @return array
     */
    public function stat(string $name, int $formatFullResponse = FullResponse::DEFAULT_RESPONSE_FULL_FIELD): array;

    /**
     * This method returns player's achievements.
     *
     * @param string $name
     * @return array
     */
    public function achievements(string $name): array;
}