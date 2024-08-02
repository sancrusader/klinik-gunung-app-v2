@php
    $users = \App\Models\User::where('role', 'manajer')->get() ?? collect([]);
@endphp

<x-dashboard.all-users :users="$users" />
