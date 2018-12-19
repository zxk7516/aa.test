<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;


use App\Validators\HashValidator;
use App\Validators\IdNumberValidator;
use App\Validators\KeepWordValidator;
use App\Validators\PhoneValidator;
use App\Validators\PhoneVerifyCodeValidator;
use App\Validators\PolyExistsValidator;
use App\Validators\TicketValidator;
use App\Validators\UsernameValidator;
use App\Validators\UserUniqueContentValidator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->registerValidators();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function registerValidators()
    {
        foreach ($this->validators as $rule => $validator) {
            Validator::extend($rule, "{$validator}@validate");
        }
    }

    protected $validators = [
        'poly_exists' => PolyExistsValidator::class,
        'phone' => PhoneValidator::class,
        'id_no' => IdNumberValidator::class,
        'verify_code' => PhoneVerifyCodeValidator::class,
        'keep_word' => KeepWordValidator::class,
        'hash' => HashValidator::class,
        'ticket' => TicketValidator::class,
        'username' => UsernameValidator::class,
        'user_unique_content' => UserUniqueContentValidator::class,
    ];

}
