  <x-front.layout-page>
      <div class="max-w-5xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
          <div class="block md:flex justify-between">
              <div class="text-[24px] font-semibold">Cerita Pendek </div>
              <form action="{{isset($category) ? route('baca-category', $category->slug) : route('baca')}}" method="get" class="flex items-center gap-1 mt-4 md:mt-0">
                  <x-text-input name="search" type="text" id="search" class="p-1 m-0 w-full md:w-72 "
                      value="{{ request('search') }}" placeholder="Masukkan kata kunci..."
                      autocomplete="none"></x-text-input>
                  <x-secondary-button class="p-1" type="submit">Cari</x-secondary-button>
              </form>
          </div>
          <div class="overflow-x-auto">
              <div class="flex gap-2 my-4 min-w-max ">
                  <a href="{{ route('baca') }}"
                      class="whitespace-nowrap pr-2 py-1 rounded-md text-sm
                  {{ !isset($category) ? 'font-bold text-[#E19B2C]' : 'text-gray-700 hover:text-[#E19B2C]' }}">
                      Semua
                  </a>

                  @foreach ($categories as $cat)
                      <a href="{{ route('baca-category', $cat->slug) }}"
                          class="whitespace-nowrap px-2 py-1 rounded-md text-sm
                      {{ isset($category) && $category->id === $cat->id
                          ? 'font-bold text-[#E19B2C]'
                          : 'text-gray-700 hover:text-[#E19B2C]' }}">
                          {{ $cat->name }}
                      </a>
                  @endforeach
              </div>
          </div>

          @if ($data->count())
              <div class="grid  md:grid-cols-3  gap-2 mt-3">
                  @foreach ($data as $key => $value)
                      <x-front.book-list title="{{ $value->title }}" desc="{{ $value->description }}"
                          author="{{ $value->user->name }}"
                          link="{{ route('book-detail', ['slug' => $value->slug]) }} "
                          thumbnails="{{ $value->thumbnail }}"></x-front.book-list>
                  @endforeach
              </div>
              <div class="mt-4">
                  {{ $data->links() }}
              </div>
          @else
              <div class="flex justify-center items-center w-full h-[400px] text-gray-600 py-10">
                  Tidak ada buku dikategori ini
              </div>
          @endif
      </div>

  </x-front.layout-page>
