<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Chart extends Component
{
    public $dates;
    public $totals;
    public $totalPaymentsThisWeek;
    public $totalPaymentsLastWeek;
    public $percentageChange;

    public function __construct($dates, $totals, $totalPaymentsThisWeek, $totalPaymentsLastWeek, $percentageChange)
    {
        $this->dates = $dates;
        $this->totals = $totals;
        $this->totalPaymentsThisWeek = $totalPaymentsThisWeek;
        $this->totalPaymentsLastWeek = $totalPaymentsLastWeek;
        $this->percentageChange = $percentageChange;
    }

    public function render()
    {
        return view('components.chart');
    }

}
