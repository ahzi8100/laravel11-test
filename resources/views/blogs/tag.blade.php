<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Tags</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 py-10">

    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold">🏷️ Manajemen Tags</h1>

        <table class="w-full table-auto border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border text-left">#</th>
                    <th class="px-4 py-2 border text-left">Nama Tag</th>
                    <th class="px-4 py-2 border text-left">Jumlah Blog</th>
                    <th class="px-4 py-2 border text-left">Judul Blog Terkait</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tags as $index => $tag)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border font-semibold">{{ $tag->name }}</td>
                        <td class="px-4 py-2 border">{{ $tag->blogs->count() }}</td>
                        <td class="px-4 py-2 border">
                            @foreach ($tag->blogs as $blog)
                                <span
                                    class="inline-block bg-gray-200 px-2 py-1 text-xs rounded mr-1 mb-1">{{ $blog->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">Belum ada tag yang tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>
