<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function index()
    {
        $data['invitations'] = Invitation::latest()->get();
        return view('invitations.index', $data);
        //return view('invitations.index', compact('invitations'));
    }

    public function create()
    {
        $data['roles'] = Role::all();
        $data['companies'] = Company::all();
        return view('invitations.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'role_id' => 'required|exists:roles,id',
        ]);

        if(User::where('email', $request->email)->exists())
        {
            return back()->withInput()->with('error', 'User already exists.');
        }

        $check = Invitation::where('email', $request->email)->where('status', 'pending')->exists();
        if($check)
        {
            return back()->withInput()->with('error', 'A pending invitation already exists for this email.');
        }

        Invitation::create([
            'company_id' => $request->company_id,
            'name'       => $request->name,
            'email'      => $request->email,
            'role_id'    => $request->role_id,
            'token'      => Str::uuid(),
            'status'     => 'pending',
            'invited_by' => auth()->id(),
        ]);

        // Email sending will be added in the next step

        return redirect()->route('invitations.index')->with('success', 'Invitation created successfully.');
    }
}
