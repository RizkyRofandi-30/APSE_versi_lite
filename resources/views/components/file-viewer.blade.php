@props(['label', 'file'])

<div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2">{{ $label }}</label>

    @if ($file)
        <div class="flex justify-between p-4 border rounded-lg bg-gray-50">

            {{-- Jika file adalah gambar --}}
            @if (Str::endsWith($file, ['jpg','jpeg','png','gif']))
                <img src="{{ asset('storage/' . $file) }}" 
                     class="w-20 h-20 object-cover rounded border"/>

            {{-- Jika file adalah PDF --}}
            @elseif(Str::endsWith($file, 'pdf'))
                <span class="text-gray-700">File PDF</span>

            @endif

            {{-- Tombol Baca --}}
            <a href="{{ asset('storage/' . $file) }}" 
                target="_blank" 
                class="text-blue-600 hover:text-blue-800 font-semibold">
                Baca
            </a>
        </div>
    @else
        <p class="text-gray-500 italic">Tidak ada file</p>
    @endif
</div>
