    @if (auth()->user()->role === 'admin')
        <x-admin-sidebar />
    @elseif(auth()->user()->role === 'paramedis')
        <x-paramedis-sidebar />
    @elseif(auth()->user()->role === 'pendaki')
        <x-pendaki-sidebar />
    @elseif(auth()->user()->role === 'dokter')
        <x-dokter-sidebar />
    @endif
