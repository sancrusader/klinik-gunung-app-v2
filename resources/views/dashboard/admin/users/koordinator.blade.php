@php
    $users = \App\Models\User::where('role', 'koordinatorPenyelamat')->get() ?? collect([]);
@endphp

<x-dashboard.all-users :users="$users" />
