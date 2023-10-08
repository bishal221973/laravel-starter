<?php

namespace App\View\Components;

use App\Models\Search;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RouteComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $routes=Search::orderBy('count','desc')->limit(6)->get();
        return view('components.route-component',compact('routes'));
    }
}
