<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="w-full md:w-1/2 py-24 mx-auto">
            <div class="mb-4">
                <h2 class="text-2xl font-medium text-grey-900 title-font">Create a new listing</h2>
            </div>
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-200 text-red-800">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form
                action="{{ route('listings.store') }}"
                id="payment_form"
                method="post"
                enctype="multipart/form-data"
                class="rounded border bg-gray-100 p-4"
            >
                @guest
                    <div class="flex mb-4">
                        <div class="flex-1 mx-2">
                            <x-label for="email" value="Email address" />
                            <x-input id="email" type="email" name="email" :value="old('email')" class="w-full" required autofocus />
                        </div>
                        <div class="flex-1 mx-2">
                            <x-label for="name" value="Full name" />
                            <x-input id="name" type="text" name="name" :value="old('name')" class="w-full" required />
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <div class="flex-1 mx-2">
                            <x-label for="password" value="Password" />
                            <x-input id="password" type="password" name="password" :value="old('password')" class="w-full" required />
                        </div>
                        <div class="flex-1 mx-2">
                            <x-label for="password_confirmation" value="Confirm password" />
                            <x-input id="password_confirmation" type="password" name="password_confirmation" class="w-full" required />
                        </div>
                    </div>
                @endguest

                <div class="mb-4 mx-2">
                    <x-label for="title" value="Job title" />
                    <x-input id="title" type="text" name="title" :value="old('title')" class="block mt-1 w-full" required autofocus />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="company" value="Company name" />
                    <x-input id="company" type="text" name="company" :value="old('company')" class="block mt-1 w-full" required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="logo" value="Company logo image" />
                    <x-input id="logo" type="file" name="logo" :value="old('logo')" />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="location" value="Location (g.e. Remote, Poland)" />
                    <x-input id="location" type="text" name="location" :value="old('location')" class="block mt-1 w-full" required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="apply_link" value="Link to apply" />
                    <x-input id="apply_link" type="text" name="apply_link" :value="old('apply_link')" class="block mt-1 w-full" required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="tags" value="Tags (e.g. php, javascript)" />
                    <x-input id="tags" type="text" name="tags" :value="old('tags')" class="block mt-1 w-full" required />
                </div>
                <div class="mb-4 mx-2">
                    <x-label for="content" value="Listing content (markdown supported)" />
                    <textarea id="content" name="content" :value="old('content')" required class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"></textarea>
                </div>
                <div class="mb-4 mx-2">
                    <label for="is_highlighted" value="Highlight">
                        <input id="is_highlighted" type="checkbox" name="is_highlighted" :value="old('is_highlighted')" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" />
                        <span class="ml-2">Hightlight this post (extra $19)</span>
                    </label>
                </div>

                <div class="mb-6 mx-2">
                    <div id="card-element"></div>
                </div>

                <div class="mb-2 mx-2">
                    @csrf
                    <input type="hidden" id="payment_method_id" name="payment_method_id" value="" />
                    <button type="submit" id="form_submit" class="block w-full items-center bg-indigo-500 text-white border-0 py-2 focus:outline-none hover:bg-indigo-600 rounded text-base mt-4 md:mt-0">Pay + Continue</button>
                </div>

            </form>
        </div>
    </section>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            classes: {
                base: 'StripeElement rounded-md shadow-sm bg-white px-2 py-3 border border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full'
            }
        });
        cardElement.mount('#card-element');
        document.getElementById('form_submit').addEventListener('click', async (e) => {
            // prevent the submission of the form immediately
            e.preventDefault();
            const { paymentMethod, error } = await stripe.createPaymentMethod('card', cardElement, {});

            if (error) {
                alert(error.message);
            } else {
                // card is ok, create payment method id and submit form
                document.getElementById('payment_method_id').value = paymentMethod.id;
                document.getElementById('payment_form').submit();
            }
        })
    </script>

</x-app-layout>
