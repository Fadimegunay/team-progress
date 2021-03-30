<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\MailSetting;
use Config;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('mail_settings')){
            $email = MailSetting::first();
            if ($email) {
                $config = array(
                    'driver'     => $email->mail_driver,
                    'host'       => $email->mail_host,
                    'port'       => $email->mail_port,
                    'username'   => $email->mail_username,
                    'password'   => base64_decode(base64_decode($email->mail_password)),
                    'encryption' => "ssl",
                    'from'       => array('address' => $email->mail_username, 'name' => "Takım Çalışması"),
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );

                Config::set('mail', $config);
            }
        }
    }
}
