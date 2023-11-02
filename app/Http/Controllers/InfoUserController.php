<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {
        // dd($request);

        $validated = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
            'image'    => ['image', 'file', 'max:5120']
        ]);

        if ($request->file('image')) {
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validated['image'] = $request->file('image')->store('profile/' . uniqid('img_'));
        }
        
        User::where('id',Auth::user()->id)
        ->update($validated);


        return redirect()->back()->with('success','Profile updated successfully');
    }
}


// if($request->get('email') != Auth::user()->email)
// {
//     if(env('IS_DEMO') && Auth::user()->id == 1)
//     {
//         return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
        
//     }
    
// }
// else{
//     $attribute = request()->validate([
//         'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
//     ]);
// }