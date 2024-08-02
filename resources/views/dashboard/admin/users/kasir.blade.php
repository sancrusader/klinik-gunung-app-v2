@php
    $users = \App\Models\User::where('role', 'kasir')->get() ?? collect([]);
@endphp

<x-dashboard.all-users :users="$users" />
