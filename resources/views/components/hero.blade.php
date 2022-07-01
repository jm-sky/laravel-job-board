<section class="text-gray-600 body-font border-b border-gray-100">
<div class="container mx-auto flex flex-col px-5 pt-16 pb-8 justify-center items-center">
    <div class="w-full md:w-2/3 flex flex-col items-center text-center">
        <h1 class="title-font sm:text-4xl text3xl mb-4 font-medium text-gray-900">Top job in the industry</h1>
        <p class="mb-8 leading-relaxed">Whether you're lookig to move to a new role...</p>
        <form class="flex w-full justify-center items-end" action="{{ route('listings.index') }}" method="get">
            <div class="relateive mr-4 w-full lg:w-1/2 text-left">
                <input type="text" name="s" value="{{ request()->s }}" class="w-full bg-gray-100 bg-opacity-50 rounded focus:ring-2 focus:ring-indigo-200 focus:bg-transparent" />
            </div>
            <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Search</button>
        </form>
        <p class="text-sm mt-2 text-gray-500 mb-8 w-full">fullstack php, vue and node, react</p>
    </div>
</div>
</section>
