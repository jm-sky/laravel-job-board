<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-12 mx-auto">
            <div class="mb-12 relative">
                <h2 class="text-2xl font-medium text-gray-900 title-font px-4 ">
                    Your listings ({{ $listings->count() }})
                </h2>
                <a href="{{ route('listings.create') }}" class="font-sm text-gray-400 hover:text-gray-600 absolute top-1 right-0">Create new listing</a>
            </div>
            <div class="-my-6">
                @foreach ($listings as $listing)
                    <a href="{{ route('listings.show', $listing->slug) }}" class="py-6 px-4 flex flex-wrap md:flex-nowrap border border-b border-gray-200 {{ $listing->is_highlighted ? 'bg-yellow-100 hover:bg-yellow-200' : 'bg-white hober:bg-gray-100' }}">
                        <div class="md:w-16 md:mb-0 mb-6 mr-4 flex-shrink-0 flex flex-col">
                            <img src="/storage/images/{{ $listing->logo }}" alt="{{ $listing->company }}" class="w-16 h-16 rounded-full object-cover">
                        </div>
                        <div class="md:w-1/2 mr-8 flex flex-col items-start justify-center">
                            <h2 class="text-xl font-bold text-gray-900 title-font mb-1">{{ $listing->title }}</h2>
                            <p class="leading-relaxed text-gray-900">{{ $listing->company }}</p> &mdash; <span class="text-gray-600">{{ $listing->location }}</span>
                        </div>
                        <div class="md:flex-grow mr-8 flex items-center justify-start">
                            @foreach($listing->tags as $tag)
                                <span class="inline-block ml-2 tracking-wide text-xs font-medium title-font py-0.5 px-1.5 border hover:bg-indigo-500 hover:text-white border-indigo-500 uppercase {{ $tag->slug == request()->tag ? 'bg-indigo-500 text-white' : 'bg-white text-indigo-500' }}">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                        <span class="md:flex-grow flex flex-col items-end justify-center">
                            <span>{{ $listing->created_at->diffForHumans() }}</span>
                            <span><strong class="text-bold">{{ $listing->clicks()->count() }} clicks</strong></span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
