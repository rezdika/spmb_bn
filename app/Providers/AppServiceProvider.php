<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // View Composer untuk notifikasi berkas
        view()->composer('user.partials.navbar', function ($view) {
            $berkasNotificationCount = 0;
            
            if (auth()->check()) {
                $pendaftaran = \App\Models\Pendaftaran::where('user_id', auth()->id())->first();
                if ($pendaftaran) {
                    $berkasNotificationCount = \App\Models\PendaftarBerkas::where('pendaftar_id', $pendaftaran->id)
                        ->whereIn('status', ['revision', 'rejected'])
                        ->count();
                }
            }
            
            $view->with('berkasNotificationCount', $berkasNotificationCount);
        });
    }

    

}
