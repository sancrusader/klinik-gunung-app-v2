<thead class="bg-gray-100 dark:bg-gray-700">
    @foreach ($headers as $header)
        <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
            {{ $header }}
        </th>
    @endforeach
</thead>
