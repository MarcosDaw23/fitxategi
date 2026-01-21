<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserPanelController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = User::select('name','email','role_id','phone','identification')->paginate(10);


        return view('admin.userPanel', ['users'=>$users]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $users = User::select('name', 'email', 'role_id', 'phone', 'identification')
            ->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('phone', 'like', "%{$search}%")
            ->orWhere('identification', 'like', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.userPanel',['users'=>$users]);
    }
}
