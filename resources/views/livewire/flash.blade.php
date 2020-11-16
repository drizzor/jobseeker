<div x-data="{ open: false }" @flash-message.window="open = true; setTimeout(() => open = false, 7000);">
    <div 
        x-show="open"
        x-cloak
        class="flex border {{ $colors[$type] }} px-2 py-2 rounded">

        {{ $message }}

    </div>
</div>
