<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchScreening extends Component
{
    public $screening;

    public function __construct($screening)
    {
        $this->screening = $screening;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-screening');
    }
}
