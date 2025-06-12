<div>
    @auth
        <form wire:submit.prevent="addComment" class="my-4 px-2">
            <textarea wire:model.defer="body" class="w-full border rounded-md border-gray-300" placeholder="Tulis Komentar..."
                name="">    </textarea>
            <div class="flex justify-end items-center gap-3">
                @error('body')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
                <button type="submit" class="bg-[#E19B2C] hover:bg-[#B37A20] text-white px-4 py-2 rounded">Kirim</button>
            </div>
        </form>
    @endauth

    <div class="px-2 mb-20">
        @foreach ($comments as $comment)
            <div class="border-b py-1 ">
                <strong class="text-gray-600">{{ "@" }}{{ $comment->user->name }}</strong>
            </div>
            <p class="pt-1">
                @if ($editingId === $comment->id)
                    <textarea wire:model.defer="editBody" id="" 
                        class="w-full border rounded-md p-1 border-gray-300"></textarea>
                    <div class="flex justify-end gap-1 md:gap-3">
                        <button wire:click="update"class="px-3 py-2 bg-[#E19B2C] text-white rounded-md">Update</button>
                        <button wire:click="$set('editingId', null)" class="px-3 py-2 bg-gray-400 text-white rounded-md">Batal</button>
                    </div>
                @else
                    {!! $comment->body !!}
                @endif
            </p>
            <div class="text-sm text-gray-600 flex gap-3 mt-3 mb-6">
                @php
                    $liked = $comment
                        ->likes()
                        ->where('user_id', auth()->id())
                        ->exists();
                @endphp

                @php
                    $liked = $comment->likes->contains('user_id', auth()->id());
                @endphp

                <button type="button" wire:click="like({{ $comment->id }})" class="flex items-center gap-1">
                    @if ($liked)
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z" />
                        </svg>
                    @endif
                    <span class="text-sm text-gray-700">{{ $comment->likes->count() }}</span>
                </button>

                @if (Auth::id() === $comment->user_id)
                <p class="text-gray-300">|</p>
                    <button type="button" wire:click="edit({{ $comment->id }})" class="text-gray-700">Edit</button>
                    <button type="button" wire:click="delete({{ $comment->id }})" class="text-red-500">Hapus</button>
                @endif
            </div>
        @endforeach
    </div>
</div>
