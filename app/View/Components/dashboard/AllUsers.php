<?php

namespace App\View\Components\dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllUsers extends Component
{
    public $users;
    public function __construct($users = [])
    {
        $this->users = $users ?? collect([]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.all-users');
    }
}
