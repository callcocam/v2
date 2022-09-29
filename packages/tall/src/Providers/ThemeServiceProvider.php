<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\LivewireBladeDirectives;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;
use Laravel\Fortify\Fortify;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ViewServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {       
        $pathViews = __DIR__ . '/../../resources/views';
        $this->loadViewsFrom($pathViews, 'tall');
        if(is_dir(resource_path('views/vendor/tall')))
        {
            $pathViews = resource_path('views/vendor/tall');
            $this->loadViewsFrom($pathViews, 'tall');
            Blade::anonymousComponentNamespace(resource_path('views/vendor/tall/components'), 'tall');
        }

        // $this->callAfterResolving(BladeCompiler::class, static function (BladeCompiler $blade): void {
        //     $blade->component(\Tall\View\Components\GuestLayout::class, 'tall-guest-layout');
        //     $blade->component(\Tall\View\Components\AppLayout::class, 'tall-app-layout');
        // });
        Blade::component("tall::layouts.guest",'tall-guest-layout');
        Blade::component("tall::layouts.app",'tall-app-layout');
        $this->configureDynamicComponent(dirname(__DIR__,2));

        Fortify::loginView(function () {
            return view(config('tall.customizing.authentication.views.auth','auth.login'));
        });
        Fortify::registerView(function () {
            return view(config('tall.customizing.authentication.views.register','auth.register'));
        }); 
        Fortify::requestPasswordResetLinkView(function () {
            return view(config('tall.customizing.authentication.views.forgot-password','auth.forgot-password'));
        });
        Fortify::resetPasswordView(function ($request) {
            return view(config('tall.customizing.authentication.views.reset-password','auth.reset-password'), ['request' => $request]);
        });
        Fortify::verifyEmailView(function () {
            return view(config('tall.customizing.authentication.views.verify-email','auth.verify-email'));
        });
        Fortify::confirmPasswordView(function () {
            return view(config('tall.customizing.authentication.views.confirm-password','auth.confirm-password'));
        });
        Fortify::twoFactorChallengeView(function () {
            return view(config('tall.customizing.authentication.views.two-factor-challenge','auth.two-factor-challenge'));
        });
        if (class_exists(Livewire::class)) {
            //SIDEBAR GLOBAL
            Livewire::component( 'tall::global.log-list', \Tall\Http\Livewire\Global\LogList::class);
        }
    }

     /**
     * Configure the component for the application.
     *
     * @return void
     */
    public function configureDynamicComponent($path,$search=".blade.php")
    {
       foreach ((new Finder)->in(sprintf("%s/resources/views/components", $path))->files()->name('*.blade.php') as $component) {                   
            $componentPath = $component->getRealPath();     
            $namespace = Str::beforeLast($componentPath, $search);
            $namespace = Str::afterLast($namespace, 'components/');
            $name = Str::replace(DIRECTORY_SEPARATOR,'.',$namespace);
            if(!Str::contains($namespace, 'tall/')){
                $this->loadComponent($name, $name);
            }
        }
    }
    
    public function loadComponent($component, $alias=null){
        if ($alias == null){
            $alias=$component;
        }
        Blade::component("tall::components.{$component}",'tall-'.$alias);
    }

    
    protected function registerBladeDirectives(): void
    {
       
        Blade::directive('toJs', static function ($expression): string {
            return LivewireBladeDirectives::js($expression);
        });
    }

}
