<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActivityKlinik extends Component
{
    public $latestScreening;
    public function __construct($latestScreening)
    {
        $this->$latestScreening = $latestScreening;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.activity-klinik');
    }
}
