<?php

declare(strict_types=1);

namespace Wnull\Warface\HttpClient;

use Http\Client\Common\Plugin;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\PluginClient;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\UriFactoryInterface;
use Wnull\Warface\Enum\HostList;
use Wnull\Warface\Enum\RegionEnum;
use Wnull\Warface\HttpClient\Plugin\BypassTimeoutResponsePlugin;

final class HttpClientConfigurator
{
    protected UriFactoryInterface $uriFactory;
    private ClientInterface $httpClient;
    private RegionEnum $region;

    public function __construct()
    {
        // set default
        $this->region = RegionEnum::CIS();
    }

    public function createConfiguredClient(): PluginClient
    {
        /** @var array<Plugin> $plugins */
        $plugins = [
            new AddHostPlugin($this->getUriFactory()->createUri('https://' . $this->getApiHost() . '/')),
            new HeaderDefaultsPlugin([
                'User-Agent' => 'warface-sdk/v5 (https://github.com/wnull/warface-sdk)',
            ]),
        ];

        // plugin only for CIS region
        if ($this->isCurrentRegionCis()) {
            $plugins[] = new BypassTimeoutResponsePlugin();
        }

        return new PluginClient($this->getHttpClient(), $plugins);
    }

    public function setHttpClient(ClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function setRegion(RegionEnum $region): self
    {
        $this->region = $region;

        return $this;
    }

    private function getUriFactory(): UriFactoryInterface
    {
        return $this->uriFactory ?? Psr17FactoryDiscovery::findUriFactory();
    }

    private function getHttpClient(): ClientInterface
    {
        return $this->httpClient ?? Psr18ClientDiscovery::find();
    }

    private function getApiHost(): string
    {
        return $this->isCurrentRegionCis() ? HostList::CIS : HostList::INTERNATIONAL;
    }

    private function isCurrentRegionCis(): bool
    {
        return $this->region->getValue() === RegionEnum::CIS;
    }
}
