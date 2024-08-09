@php
    $users = \App\Models\User::where('role', 'pasien')->get() ?? collect([]);
@endphp

<x-dashboard.all-users :users="$users" />
