@if (session()->has('message'))
    <div x-data="{ open: true }" x-init="setTimeout(()=> open = false, 3000)"  x-show="open" class="fixed top-0 transform -translate-x-1/2 bg-laravel left-1/2 text-white px-48 py-3">
    <p >
        {{session( 'message') }} <span @click="open= false "><i class="fa-solid fa-xmark"></i></span>
    </p>                    
    </div>    
@endif