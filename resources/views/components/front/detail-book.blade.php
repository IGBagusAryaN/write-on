  
  <x-front.layout-page>
    <x-slot name="pageTitle">{{ $data->title }}</x-slot>
        <div class="max-w-5xl mx-auto mt-5 px-4 sm:px-6 lg:px-8">
          <div class="grid grid-cols-[0.9fr_3fr] p-2 gap-3 h-full">
                <div class="text-[16px] text-gray-700 mt-3">
                    <img src="{{ asset(getenv('CUSTOM_THUMBNAILS_LOCATION').'/'.$data->thumbnail) }}" alt="" width="200" height="200">
                    <div class="mt-2">Penulis : {{ $data->user->name }}</div>
                    <div>Terbit : {{ $data->created_at->isoFormat('dddd, D MMMM Y')  }}</div>
                </div>
                <div class="flex flex-col justify-between">
                    <div class="max-w-3xl">
                        <div class="font-semibold text-[24px]">{{ $data->title }}</div>
                        <p class="text-[16px] text-gray-500 text-justify">{!! $data->content !!} </p>
                         <div class="flex items-center justify-between mt-9">
                      
                          <div> 
                              @if ($pagination['next'])
                                  <a href="{{ route('book-detail', ['slug'=>$pagination['next']->slug])}}" class="text-blue-400"> &larr;{{$pagination['next']->title}}</a>
                              @else
                                  <span></span>
                              @endif
                          </div>
                              <div> 
                              @if ($pagination['prev'])
                                  <a href="{{ route('book-detail', ['slug'=>$pagination['prev']->slug])}}" class="text-blue-400"> {{ $pagination['prev']->title}}&rarr;</a>
                              @else
                                  <span></span>
                              @endif
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
  </x-front.layout-page>