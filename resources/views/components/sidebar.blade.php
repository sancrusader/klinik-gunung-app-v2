    @if (auth()->user()->role === 'admin')
        <x-admin-sidebar />
    @elseif(auth()->user()->role === 'paramedis')
        <x-paramedis-sidebar />
    @elseif(auth()->user()->role === 'pendaki')
        <x-pendaki-sidebar />
    @elseif(auth()->user()->role === 'dokter')
        <x-dokter-sidebar />
    @elseif(auth()->user()->role === 'kasir')
        <x-kasir-sidebar />
    @elseif(auth()->user()->role === 'manajer')
        <x-manajer-sidebar />
    @elseif(auth()->user()->role === 'koordinator')
        <x-koordinator-sidebar />
    @endif
