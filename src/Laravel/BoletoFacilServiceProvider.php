<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 2018-12-21
 * Time: 16:21
 */

namespace Louisk\BoletoFacil\Laravel;


use Louisk\BoletoFacil\BoletoFacilService;
use Louisk\BoletoFacil\Laravel\Commands\GerarBoleto;
use Louisk\BoletoFacil\Resources\AuthResource;
use Illuminate\Support\ServiceProvider;

class BoletoFacilServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/boleto-facil.php' => config_path('boleto-facil.php'),
        ], 'boleto-facil');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(
            GerarBoleto::class
        );

        $this->app->singleton('boleto-facil', function(){

            $token = config('boleto-facil.token', env('BOLETO_FACIL_TOKEN'));

            $sandbox = config('boleto-facil.sandbox', env('BOLETO_FACIL_SANDBOX'));

            $notificationUrl = config('boleto-facil.notification_url');

            return new BoletoFacilService(new AuthResource($token, $sandbox, $notificationUrl));

        });
    }

    public function provides()
    {
        return ['boleto-facil'];
    }
}
