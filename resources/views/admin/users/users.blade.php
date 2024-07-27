@php
    $users = \App\Models\User::all() ?? collect([]);
@endphp

<x-dashboard.all-users :users="$users" />
