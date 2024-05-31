@props(['listingCard'])
            <x-card>
                <!-- Item 1 -->
                    <div class="flex">
                        <img
                            class="hidden w-48 mr-6 md:block"
                            src="{{$listingCard->logo ? asset('storage/'. $listingCard->logo) : asset('/images/no-image.png')}}"
                            alt=""
                        />
                        <div>
                            <h3 class="text-2xl">
                                <a href="listing/{{$listingCard->id}}">{{$listingCard->title}}</a>
                            </h3>
                            <div class="text-xl font-bold mb-4">{{$listingCard->company}}</div>
                            <x-listing-tags  :tagsCsv="$listingCard->tags"  />
                                <div class="text-lg mt-4">
                                <i class="fa-solid fa-location-dot"></i> {{$listingCard->location }} <span>{{$listingCard->created_at}}</span>
                            </div>
                        </div>
                    </div>
            </x-card>

 