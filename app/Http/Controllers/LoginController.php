<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pupil;

class LoginController extends Controller
{
    public function login(Request $request){
        $credentials = $request->only('user_id', 'password');
        if (Auth::attempt($credentials, $request->get('remember_token'))) {
            $user = auth()->user();

            if ($user->isAdmin()){
                return redirect(route('admin.admin-main'));
            }
            if ($user['user_type'] == 'Учитель'){
                //Редирект на соответствующую страницу
            }
            if ($user['user_type'] == 'Ученик'){
                echo $user->pupil->mark[1]->subject->name;
//                dd(Pupil::all()->first());
                //Редирект на соответствующую страницу
            }
            return $user;
            //return redirect()->intended('index');
        }
        return redirect(route('index'));
    }
}
