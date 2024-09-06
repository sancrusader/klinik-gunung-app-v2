@foreach ($screenings as $screening)
    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
        <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $screening->queue_number }}
        </td>
        <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $screening->full_name }}
        </td>
        <td>
            <form action="{{ route('paramedis.confirm', $screening->id) }}" method="POST">
                @csrf
                <select name="health_check_result" class="form-control" required>
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="sehat">Tidak Didampingi (Sehat)</option>
                    <option value="butuh_pendamping">Butuh Pendamping</option>
                    <option value="butuh_dokter">Butuh Dokter</option>
                </select>
                <button type="button" data-modal-target="modal-confirm" data-modal-toggle="modal-confirm"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Confirm
                </button>
            </form>
        </td>
    </tr>
@endforeach
