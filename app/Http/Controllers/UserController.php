<?php
 
namespace App\Http\Controllers;

use App\Model\User;
use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AppInstallation;

class UserController extends Controller
{
    public function setPassword(Request $request, $token)
    {
    	$user = \App\Model\User::where('reset_token','=',$token)->firstOrFail();

    	return view('reset_password', ['user' => $user]);
    }

    public function update(Request $request, $token)
    {
        $user = \App\Model\User::where('reset_token','=',$token)->firstOrFail();

        $user->password_hash = password_hash($request['password'], PASSWORD_BCRYPT);
        $user->reset_token = null;
        $user->save();

        return redirect('/');
    }

    public function login(Request $request)
    {
    	if (isset($_SESSION['user_id']) === false) {
    		return view('login');	
    	} else {
    		return redirect('/');
    	}
    }

    public function logout()
    {
    	$_SESSION['user_id'] = null;
    	return redirect('/login');
    }

    public function authenticate(Request $request)
    {
    	$user = User::where('username', '=', $request['username'])->first();

    	if ($user) {
    		if ($user->authenticate($request['password'])){
    			$_SESSION['user_id'] = $user->user_id;
    			return redirect('/');
    		}
    	} 
    	return redirect('/login');
    }
}