<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardNavbar extends Component
{
    /**
     * Create a new component instance.
     */
    public $unreadNotifications;

    public function __construct()
    {
        $user = Auth::user();

        if ($user->hasRole('paramedis')) {
            $this->unreadNotifications = $user->unreadNotifications->where('type', 'App\Notifications\NewScreeningNotification');
        } elseif ($user->hasRole('dokter')) {
            $this->unreadNotifications = $user->unreadNotifications->where('type', 'App\Notifications\NewAppointmentNotification');
        } else {
            $this->unreadNotifications = collect(); // Kosongkan jika tidak ada role yang relevan
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.dashboard-navbar');
    }
}
