<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <div class="mb-12">
                <h2 class="text-2xl font-medium text-gray-900 title-font">{{ $listing->title }}</h2>
                <div class="md:flex-grow mr-8 mt-2 flex items-center justify-start gap-2">
                    @foreach($listing->tags as $tag)
                        <span class="tag-item">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="-my-6">
                <div class="flex flex-wrap md:flex-nowrap">
                    <div class="content w-full md:w-3/4 pr-4 leading-relaxed text-base">
                        {!! $listing->content !!}
                    </div>
                    <div class="w-full md:w-1/4 pl-4">
                        <img
                            src="/storage/images/{{ $listing->logo }}"
                            alt="{{ $listing->company }} logo"
                            class="max-w-full mb-4"
                        >
                        <p class="leading-relaxed text-base">
                            <strong>Location: </strong>{{ $listing->location }}<br>
                            <strong>Company: </strong>{{ $listing->company }}
                        </p>
                        <a href="{{ route('listings.apply', $listing->slug) }}" class="block text-center my-4 tracking-wide bg-white text-indigo-500 text-sm font-medium title-font py-2 border rounded border-indigo-500 hover:bg-indigo-500 hover:text-white uppercase">Apply Now</a>

                        @if($listing->user_id == Auth::id())
                        <a href="{{ route('listings.remove', $listing->slug) }}" class="block text-center my-4 tracking-wide bg-white text-red-500 text-sm font-medium title-font py-2 border rounded border-red-500 hover:bg-red-500 hover:text-white uppercase">Delete</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
