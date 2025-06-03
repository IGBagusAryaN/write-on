@props(['value', 'id', 'name'])
<input id="{{ $id }}" type="hidden" name="{{ $name }}" value="{{ $value }}">
<trix-editor input="x"
    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm min:h-80"></trix-editor>
