<?php

namespace App\Providers;

use App\Models\Notificacion;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewDataComposer extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Lógica para obtener datos de la base de datos
            $notificaciones = Notificacion::all();

            // Compartir la variable con la vista
            $view->with('notificaciones', $notificaciones);
        });
    }
}
