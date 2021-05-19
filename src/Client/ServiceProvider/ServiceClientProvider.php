<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 */

namespace Samego\Client\ServiceProvider;

use Illuminate\Support\ServiceProvider as FrameworkServiceProvider;
use Samego\Client\Contracts\HttpRequestInterface;
use Samego\Client\Supports\Http\Request;

/**
 * Created by AlicFeng at 2021/5/19 上午12:03.
 */
class ServiceClientProvider extends FrameworkServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->publishConfig();

        $this->app->bind(HttpRequestInterface::class, function () {
            return new Request(config('service_client.http'), config('service_client.arrangement'));
        });
    }

    public function publishConfig()
    {
        $this->publishes(
            [
                __DIR__ . '/../../../config/service_client.php' => config_path('service_client.php'),
            ],
            'service_client'
        );
    }
}
