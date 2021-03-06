<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use App\Mail\MailChanged;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        User::created(function($user) {

            if($user->verification_token != null) {

                retry(5, function() use ($user){
                    Mail::to($user->email)->queue(new VerificationEmail($user));
                }, 100);
            }

        });

        User::updated(function($user){

            if($user->isDirty('email')){
                
                retry(5, function() use ($user) {
                    Mail::to($user->email)->queue(new MailChanged($user));
                }, 100); 
            }
        });

        Product::updated( function($product) {
            if($product->quantity == 0 && $product->isAvailable()) {
                $product->status = Product::UNAVAILABLE_PRODUCT;
                $product->save();
            }
        });
    }
}
