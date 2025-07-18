@props([
    'id' => 'password',
    'name' => 'password',
    'label' => 'Password',
    'placeholder' => 'Password123',
])

<div class="">
    <div class="relative mt-1">
        <x-text-input
            :id="$id"
            :name="$name"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="$placeholder"
            class="block w-full pr-10"
        />

        {{-- Toggle Eye Button --}}
        <button type="button" onclick="togglePassword('{{ $id }}')"
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500">

            {{-- Eye (show) --}}
            <svg id="{{ $id }}-eye" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                fill="currentColor" class="size-6">
                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                <path fill-rule="evenodd"
                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                    clip-rule="evenodd" />
            </svg>

            {{-- Eye Off (hide) --}}
            <svg id="{{ $id }}-eye-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                fill="currentColor" class="size-6 hidden">
                <path
                    d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577a11.217 11.217 0 0 1 4.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM12.53 15.713l-4.243-4.244a3.75 3.75 0 0 0 4.244 4.243Z" />
                <path
                    d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 0 0-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 0 1 6.75 12Z" />
            </svg>
        </button>
    </div>

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>

@once
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const eye = document.getElementById(id + '-eye');
            const eyeOff = document.getElementById(id + '-eye-off');

            if (input.type === 'password') {
                input.type = 'text';
                eye.classList.add('hidden');
                eyeOff.classList.remove('hidden');
            } else {
                input.type = 'password';
                eye.classList.remove('hidden');
                eyeOff.classList.add('hidden');
            }
        }
    </script>
@endonce
