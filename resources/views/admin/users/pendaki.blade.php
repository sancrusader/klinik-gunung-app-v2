@php
    $users = \App\Models\User::where('role', 'pendaki')->get() ?? collect([]);
@endphp

<x-dashboard.all-users :users="$users" />
