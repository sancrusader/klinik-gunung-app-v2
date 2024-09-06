<x-dashboard.dashboard-layout>
    <x-slot:title>Screening Offline Payment</x-slot:title>
    <x-table-header action="{{ route('kasir.search') }}" placeholder="Search by name" name="Payments">
        <x-toast />
        <x-th :headers="['Queue Number', 'Full Name', 'Status', 'Payment Status']" />
        <tbody>
            @foreach ($screenings as $screening)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <x-td>{{ $screening->queue_number }}</x-td>
                    <x-td>{{ $screening->full_name }}</x-td>
                    <x-td>{{ $screening->health_check_result }}</x-td>
                    <x-td>{{ $screening->payment_status ? 'Sudah Bayar' : 'Belum Bayar' }}
                    </x-td>
                    <x-td>
                        <form action="{{ route('kasir.confirm', $screening->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="amount_paid"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                                    Jumlah Pembayaran
                                </label>
                                <input type="number" name="amount_paid" id="amount_paid" required
                                    class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan jumlah pembayaran">
                            </div>
                            <button type="submit"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                {{ $screening->payment_status ? 'disabled' : '' }}>
                                Konfirmasi Pembayaran
                            </button>
                        </form>
                    </x-td>
                </tr>
            @endforeach
        </tbody>
    </x-table-header>
</x-dashboard.dashboard-layout>
