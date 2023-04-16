<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <div class="mb-12">
                <h2 class="text-2xl font-medium text-gray-900 title-font">{{ $listing->title }}</h2>
            </div>
            <div class="-my-6">
            <div class="-m-2 p-4 border border-red-500 rounded">
                Do You really want to remove this listing?
                <div class="flex flex-wrap md:flex-nowrap">
                    <a href="{{ route('listings.destroy', $listing->slug) }}" class="block text-center py-2 px-3 my-4 tracking-wide bg-white text-red-500 text-sm font-medium title-font border rounded border-red-500 hover:bg-red-500 hover:text-white uppercase">Yes, delete</a>
                </div>
            </div>
            </div>
        </div>
    </section>
</x-app-layout>
