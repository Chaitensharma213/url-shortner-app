<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $role = $user->role->name;
        //echo "<pre>"; print_r($user->toArray()); die;

        if($role == 'Super Admin')
        {
            $data['shortUrls'] = ShortUrl::with(['company', 'user'])->latest()->paginate(10);
        }
        elseif($role == 'Admin')
        {
            $data['shortUrls'] = ShortUrl::where('company_id', $user->company_id)->with(['company', 'user'])->latest()->paginate(10);
        }
        elseif($role == 'Member')
        {
            $data['shortUrls'] = ShortUrl::where('user_id', $user->id)->with(['company', 'user'])->latest()->paginate(10);
        }
        else
        {
            abort(403, 'Unauthorized');
        }

        return view('short_urls.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('short_urls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(auth()->user()->role->name == 'Super Admin')
        {
            abort(403, 'SuperAdmin cannot create Short URLs.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'original_url' => 'required|url',
        ]);

        ShortUrl::create([
            'company_id'   => Auth::user()->company_id ?? 1,
            'user_id'      => Auth::id(),
            'title'        => $request->title,
            'original_url' => $request->original_url,
            'short_code'   => $this->generateShortCode(),
        ]);

        return redirect()->route('short-urls.index')->with('success', 'Short URL created successfully.');
    }

    private function generateShortCode($length = 8)
    {
        $code = Str::random($length);

        if(ShortUrl::where('short_code', $code)->exists())
        {
            return $this->generateShortCode($length);
        }
        return $code;
    }

    public function redirect_url($short_code)
    {
        $shortUrl = ShortUrl::where('short_code', $short_code)->first();

        if (!$shortUrl) {
            abort(404, 'Short URL not found.');
        }

        return redirect()->away($shortUrl->original_url);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
