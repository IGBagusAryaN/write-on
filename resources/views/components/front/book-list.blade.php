@props(['title', 'desc', 'author', 'link' ,'thumbnails'])    
    
    <div class="border flex p-2 gap-2 h-full w-full">
        <img src="{{ asset(getenv('CUSTOM_THUMBNAILS_LOCATION').'/'.$thumbnails) }}" alt=""
            width="120" height="120">
        <div class="flex flex-col justify-between w-full">
            <div>
                <div class="text-[12px]">{{ $author }}</div>
                <div class="font-semibold text-[16px]">{{ $title }}</div>
                <p class="text-[12px] text-gray-500">{{ $desc }}</p>
            </div>
            <div class="flex items-end justify-end">
                <a href="{{ $link}}" class="text-[14px] text-blue-400">Baca &raquo;</a>
            </div>
        </div>

    </div>
