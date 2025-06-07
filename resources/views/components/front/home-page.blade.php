  
  <x-front.layout-page>
  <div class="max-w-5xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
        <div class="text-[24px]">Cerita Pendek </div>
        <div class="grid  md:grid-cols-3  gap-2 mt-3">
            {{-- <div class="border flex p-2 gap-2 h-full">
                <img src="https://inc.mizanstore.com/aassets/img/com_cart/produk/covGA001942_thumb.jpg" alt="" width="120" height="120">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="text-[12px]">Raditya dika</div>
                        <div class="font-semibold text-[16px]">Koala Kumala</div>
                        <p class="text-[12px] text-gray-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus fugit esse consectetur illo neque amet!</p>
                    </div>
                    <div class="flex items-end justify-end">
                          <a href="{{ url('/detail-book') }}" class="text-[14px] text-blue-400">Baca &raquo;</a>
                    </div>
                </div>
              
            </div>
            <div class="border flex p-2 gap-2 h-full">
                <img src="https://cdn.gramedia.com/uploads/items/9786022202325C_9786022202325.jpg" alt="" width="120" height="120">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="text-[12px]">Raditya dika</div>
                        <div class="font-semibold text-[16px]">Marmut Merah Jambu</div>
                        <p class="text-[12px] text-gray-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus fugit esse consectetur illo neque amet!</p>
                    </div>
                    <div class="flex items-end justify-end">
                          <a href="" class="text-[14px] text-blue-400">Baca &raquo;</a>
                    </div>
                </div>
              
            </div>
            <div class="border flex p-2 gap-2 h-full">
                <img src="https://upload.wikimedia.org/wikipedia/id/8/8f/Ubur-ubur-Lembur1.jpg" alt="" width="120" height="120">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="text-[12px]">Raditya dika</div>
                        <div class="font-semibold text-[16px]">Ubur-ubur Lembur</div>
                        <p class="text-[12px] text-gray-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus fugit esse consectetur illo neque amet!</p>
                    </div>
                    <div class="flex items-end justify-end">
                          <a href="" class="text-[14px] text-blue-400">Baca &raquo;</a>
                    </div>
                </div>
              
            </div> --}}
            @foreach ($data as $key=>$value)
            <x-front.book-list title="{{ $value->title }}" desc="{{ $value->description }}" author="{{ $value->user->name }}" link="{{ route('book-detail', ['slug'=> $value->slug]) }} " thumbnails="{{ $value->thumbnail }}"></x-front.book-list>
            @endforeach
        </div>
    </div>

    </x-front.layout-page>