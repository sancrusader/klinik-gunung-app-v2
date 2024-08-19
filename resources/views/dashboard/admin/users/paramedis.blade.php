@php
    $users = \App\Models\User::where('role', 'paramedis')->get() ?? collect([]);
@endphp

<x-dashboard.all-users :users="$users" />
