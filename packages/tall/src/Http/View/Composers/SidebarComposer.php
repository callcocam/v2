<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace Tall\Http\View\Composers;

use Tall\Main\SidebarPanel;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!is_null(request()->route())) {
            $pageName = request()->route()->getName();
            $routePrefix = explode('/', $pageName)[0];

            switch ($routePrefix) {
                case 'elements':
                    $view->with('sidebarMenu', SidebarPanel::elements());
                    break;
                case 'components':
                    $view->with('sidebarMenu', SidebarPanel::components());
                    break;
                case 'forms':
                    $view->with('sidebarMenu', SidebarPanel::forms());
                    break;
                case 'layouts':
                    $view->with('sidebarMenu', SidebarPanel::layouts());
                    break;
                case 'apps':
                    $view->with('sidebarMenu', SidebarPanel::apps());
                    break;
                case 'dashboards':
                    $view->with('sidebarMenu', SidebarPanel::dashboards());
                    break;
                default:
                    $view->with('sidebarMenu', SidebarPanel::dashboards());
            }
            $view->with('pageName', $pageName);
            $view->with('routePrefix', $routePrefix);
        }
    }
}
