<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Config;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $mailSetting = settings()->get('mail_transport');
        if ($mailSetting) {

            $data = [
                'driver' => settings()->get('mail_transport'),
                'host' => settings()->get('mail_host'),
                'port' => settings()->get('mail_port'),
                'encryption' => settings()->get('mail_encryption'),
                'username' => settings()->get('mail_username'),
                'password' => settings()->get('mail_password'),
                'from'=>[
                    'address'=>settings()->get('mail_from'),
                    'name'=>settings()->get('mail_from_name'),
                ]
            ];

            Config::set("mail",$data);
        }
    }
}
