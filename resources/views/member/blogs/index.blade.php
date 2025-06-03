<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <a href="{{ route('member.blogs.create') }}"
                class="bg-blue-400 rounded-md p-2 ml-2 text-white text-[16px]">Tambah Cerita</a>
        </h2>
    </x-slot>
    <x-slot name="headerRight">
        <form action="{{ route('member.blogs.index') }}" method="get" class="flex items-center gap-1 mt-4 md:mt-0">
            <x-text-input name="search" type="text" id="search" class="p-1 m-0 md:w-72 "
                value="{{ request('search') }}" placeholder="Masukkan kata kunci..."></x-text-input>
            <x-secondary-button class="p-1" type="submit">Cari</x-secondary-button>
        </form>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  sm:rounded-lg overflow-x-auto">
                <div class="p-6 bg-white">
                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap table-fixed">
                        <thead>
                            <tr class="text-center font-bold">
                                <td class="border px-6 py-4 w-[80px]">No</td>
                                <td class="border px-6 py-4">Judul</td>
                                <td class="border px-6 py-4 lg:w-[250px] hidden lg:table-cell">Tanggal</td>
                                <td class="border px-6 py-4 lg:w-[100px] hidden lg:table-cell">Status</td>
                                <td class="border px-6 py-4 lg:w-[250px] w-[100px]">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $value)
                                <tr>
                                    <td class="border px-6 py-4 text-center">{{ $data->firstItem() + $key }}</td>
                                    <td class="border px-6 py-4">
                                        {{ $value->title }}
                                        <div class="block lg:hidden text-sm text-gray-500">
                                            {{ $value->status }} | {{ $value->created_at->isoFormat('dddd, D MMMM Y') }}
                                        </div>
                                    </td>
                                    <td class="border px-6 py-4 text-center text-gray-500 text-sm hidden lg:table-cell">
                                        {{ $value->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                                    <td class="border px-6 py-4 text-center text-sm hidden lg:table-cell">
                                        {{ $value->status }}</td>
                                    <td class="border px-6 py-4 text-center">
                                        <a href='{{ route('member.blogs.edit', ['post' => $value->id]) }}'
                                            class="text-blue-600 hover:text-blue-400 px-2">edit</a>
                                        @if ($value->status !== 'draft')
                                            <a href='{{  route('book-detail', ['slug'=> $value->slug])  }}' class="text-blue-600 hover:text-blue-400 px-2">lihat</a>
                                        @endif
                                        <form method="POST" class="inline"
                                            onsubmit="return confirm('Yakin Menghapus Buku ini?')"
                                            action="{{ route('member.blogs.destroy', ['post' => $value->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type=' submit' class='text-red-600 hover:text-red-400 px-2'>
                                                hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="py-5">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
