@php
    $users = \App\Models\User::where('role', 'dokter')->get() ?? collect([]);
@endphp

<x-dashboard.all-users :users="$users" />
