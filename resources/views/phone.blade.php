<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Nomor Telepon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-10">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">📱 Daftar Nomor Telepon</h1>

        <table class="w-full mt-4 border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-4 py-2 border">#</th>
                    <th class="text-left px-4 py-2 border">Nama Provider</th>
                    <th class="text-left px-4 py-2 border">Nomor Telepon</th>
                    <th class="text-center px-4 py-2 border">Pelanggan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($phones as $index => $phone)
                    <tr class="border-t">
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $phone->provider_name }}</td>
                        <td class="px-4 py-2 border">{{ $phone->phone_number }}</td>
                        <td class="px-4 py-2 border">{{ $phone->user->name }}</td>
                    </tr>
                @endforeach

                @if ($phones->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">Tidak ada data nomor telepon.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</body>

</html>
