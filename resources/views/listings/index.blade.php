@extends('layout')

@section('content')

@include('partials._hero')

@include('partials._search')

{{-- <div x-data="{ open: false }">
    <button @click="open = true">Expand</button>
    <span x-show="open">hello message</span>
</div> --}}

<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4" >
    @if (count($listings) > 0 )
        @foreach ($listings as $listing)
            <x-listing-card :listingCard="$listing" />
        @endforeach
    @else
            <p>No listing Found.</p>    
    @endif
</div>
<div class="mt-6 p-4">
    {{$listings->links()}}
</div>
@endsection
