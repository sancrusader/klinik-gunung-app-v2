<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PasienChart extends Component
{
    public $totalPatients;
    public $totalsPasien;
    public $datesPasien;
    public function __construct($datesPasien, $totalsPasien, $totalPatients)
    {
        $this->datesPasien = $datesPasien;
        $this->totalsPasien = $totalsPasien;
        $this->$totalPatients = $totalPatients;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pasien-chart');
    }
}
