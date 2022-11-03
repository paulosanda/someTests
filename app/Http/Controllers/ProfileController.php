<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'avatar' => [
                'required',
                'file',
                'image',
                'max:1024'
            ],
        ]);
        $user_id = Auth::user()->id;
        User::where('id', $user_id)->delete();
        $this->file('file')->storeAs('public', $request->avatar);
    }
}
