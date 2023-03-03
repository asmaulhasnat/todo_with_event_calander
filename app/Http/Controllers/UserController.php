<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Services\Validator\CustomerValidator as UserValidator;
use Auth;
use PDF;

class UserController extends Controller
{
    public function index(Request $req)
    {
        $data['user'] = User::getAllNotMe($req,Auth::user()->id);
        return view('user.index', $data);
    }
    public function create()
    {
        $data['dial_code'] = dial_code();
        return view('user.create', $data);
    }

    public function store(UserValidator $cus)
    {


        $req = $cus->checkValidation('user');

        if (isset($req['fail'])) {
            return back()->withErrors($req['fail']);
        }
        if ($req->role == 1) {
            $is_admin = 1;
        } else {
            $is_admin = 0;
        }
        $password = bcrypt($req->password);
        $collection = array_merge($req->except('password'), ['is_admin' => $is_admin, 'password' => $password]);

        $user = User::storeData($collection);
        return success_error($user['status'] ?? null, 'user');
    }

    public function edit($id)
    {
        $data['dial_code'] = dial_code();
        $data['user'] = User::findById($id);
        return view('user.edit', $data);
    }

    public function update(UserValidator $cus, $id)
    {
        $status_code = '';

        $req = $cus->checkValidation('user', $id);

        if (isset($req['fail'])) {
            return back()->withErrors($req['fail']);
        }
        if ($req->role == 1) {
            $is_admin = 1;
        } else {
            $is_admin = 0;
        }

        $collection = array_merge($req->except(['_token', 'password', 'password_confirmation']), ['is_admin' => $is_admin]);
        if ($req->password) {
            $collection = array_merge($collection, ['password' => bcrypt($req->password)]);
        }

        $user = User::updateData($collection, $id);

        return success_error($user['status'] ?? null, 'user');
    }

    public function delete($id)
    {

        $user = User::deleteById($id);
        return success_error($user['status'] ?? null);
    }



    

    public function profile(){
        $data['user'] = User::findById(Auth::user()->id);
        return view('user.profile', $data);  
    }

    public function profileUpdate(UserValidator $cus){
        $id= Auth::user()->id;
        $req = $cus->checkValidation('user_profile', $id);
        if (isset($req['fail'])) {
            return back()->withErrors($req['fail']);
        }
        $collection = $req->except(['_token']);
        $user = User::updateData($collection, $id);
        return success_error($user['status'] ?? null, 'user.profile');
    }

    public function changePasswordForm(){
        return view('user.change_password');  
    }

    public function passwordUpdate(UserValidator $cus){
        $id= Auth::user()->id;
        $req = $cus->checkValidation('change_password', $id);
        if (isset($req['fail'])) {
            return back()->withErrors($req['fail']);
        }

        $collection = $req->except(['_token', 'password', 'password_confirmation']);
        if ($req->password) {
            $collection = array_merge($collection, ['password' => bcrypt($req->password)]);
        }
        $user = User::updateData($collection, $id);
        return success_error($user['status'] ?? null, 'user.password');
    }

    
}
