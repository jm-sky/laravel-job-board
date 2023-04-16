<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listings = Listing::active()->with('tags')->latest()->get();
        $tags = Tag::orderBy('name')->get();

        if ($request->has('s')) {
            $search = strtolower($request->s);
            $listings = $listings->filter(Listing::searchFilter($search));
        }

        if ($tag = $request->tag) {
            $listings = $listings->filter(function($listing) use ($tag) {
                return $listing->tags->contains('slug', $tag);
            });
        }

        return view('listings.index', compact('listings', 'tags'));
    }


    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing, Request $request)
    {
        return view('listings.show', compact('listing'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function apply(Listing $listing, Request $request)
    {
        $listing->clicks()->create([
            'user_agent' => $request->userAgent(),
            'ip' => $request->ip()
        ]);

        return redirect()->to($listing->apply_link);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationArray = [
            'title' => 'required',
            'company' => 'required',
            'logo' => 'file|max:2048',
            'location' => 'required',
            'apply_link' => 'required|url',
            'content' => 'required',
            'payment_method_id' => 'required',
        ];

        if (! Auth::check()) {
            $validationArray = array_merge([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:5',
            ]);
        }

        $request->validate($validationArray);
        $user = $this->getOrCreateUserAndLogin($request);

        try {
            $amount = 9900; // 99.00 USD

            if ($request->filled('is_highlighted')) $amount += 1900;

            $user->charge($amount, $request->payment_method_id);

            $md = new \ParsedownExtra();
            $listing = $user->listings()->create([
                'title' => $request->title,
                'slug' => Str::slug($request->title) . '-' . rand(1111, 9999),
                'company' => $request->company,
                'logo' => basename(optional($request->file('logo'))->store('public/images')),
                'location' => $request->location,
                'apply_link' => $request->apply_link,
                'content' => $md->text($request->content),
                'is_highlighted' => $request->filled('is_highlighted'),
                'is_active' => true,
            ]);

            foreach (explode(',', $request->tags) as $requestTag) {
                $tag = Tag::firstOrCreate([
                    'slug' => Str::slug(trim($requestTag))
                ], [
                    'name' => ucwords(trim($requestTag))
                ]);

                $tag->listings()->attach($listing->id);
            }

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function remove(Listing $listing)
    {
        return view('listings.remove', compact('listing'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        if ($listing->user_id != Auth::id()) {
            return redirect()->back()->withErrors(['error' => 'It is not Your listing']);
        }

        $listing->delete();

        return redirect('dashboard');
    }


    /**
     * @return object
     */
    protected function getOrCreateUserAndLogin(Request $request)
    {
        $user = Auth::user();

        if ($user) return $user;

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->createAsStripeCustomer();

        Auth::login($user);

        return $user;
    }
}
