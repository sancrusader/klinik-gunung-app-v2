@php
    $users = \App\Models\User::where('role', 'admin')->get() ?? collect([]);
@endphp

<x-dashboard.all-users :users="$users" />
