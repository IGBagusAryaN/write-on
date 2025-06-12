<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Tambah Data Tulisan
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Silakan melakukan penambah data
                            </p>
                        </header>

                        <form method="post" action="{{ route('member.books.store') }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <x-input-label for="title" value="Title" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    value="{{ old('title') }}" />
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for="description" value="Description" />
                                <x-text-input id="description" name="description" type="text"
                                    class="mt-1 block w-full" value="{{ old('description') }}" />
                                @error('description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>

                                <x-input-label for="file_input" value="Thumbnail" />
                                <input type="file"
                                    class="w-full border border-gray-300 rounded-md outline-none file:cursor-pointer file:border-0 file:rounded-md file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:text-gray-700"
                                    name="thumbnail" />

                                @error('thumbnail')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <x-input-label for="content" value="Content" />
                                <x-textarea-trix value="{!! old('content') !!}" name="content"
                                    id="x"></x-textarea-trix>
                            </div>

                            <div class="mb-4">
                                <label for="category_id"
                                    class="block font-medium text-sm text-gray-700">Kategori</label>
                                <select name="category_id" id="category_id" class="form-select mt-1 block w-full rounded-md border-gray-300">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (old('category_id') ?? ($data->category_id ?? '')) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-select name="status">
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Simpan
                                        sebagai
                                        draft</option>
                                    <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish
                                    </option>
                                </x-select>
                            </div>
                            <div class="flex items-center gap-4">
                                <a href="{{ route('member.books.index') }}">
                                    <x-secondary-button>Kembali</x-secondary-button>
                                </a>
                                <x-primary-button>Simpan</x-primary-button>
                            </div>

                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
