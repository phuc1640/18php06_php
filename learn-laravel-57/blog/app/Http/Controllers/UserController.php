<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('admin.dashboard');
    }

    public function listUser(Request $request)
    {   
        if ($request->has('filter')) {
            $filter = $request->filter;
            $filter = '%' . $filter . '%';
            $users = DB::table('users')->where('name', 'like', $filter)->get();
        } else {
            $users = DB::table('users')->get();
        }
        

    	return view('admin.users.listUser', ['users'=> $users]);
    }

    public function getAddUser()
    {   
        $user = (object) [
            'name' => '',
            'email' => '',
            'password' => '',
            'validatePassword' => ''
        ];
    	return view('admin.users.addUser', ['user' => $user]);
    }

    public function addUser(Request $request)
    {
    	$name = $request->name;
    	$email = $request->email;
    	$password = $request->password;
        $validatePassword = $request->validatePassword;
        $user = (object) [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'validatePassword' => $validatePassword
        ];
        $success = false;
        if ($password == $validatePassword && $password != null) {
            $password = Hash::make($request->password);
            DB::table('users')->insert(['name' => $name, 'email' => $email, 'password' => $password]);
            $user = (object) [
                'name' => '',
                'email' => '',
                'password' => '',
                'validatePassword' => ''
            ];
            $success = true;
        } else {
            $success = false;
        }
    	return view('admin.users.addUser', ['success' => $success, 'user' => $user]);
    }

    public function deleteUser(Request $request)
    {
        $isDeleteSuccess = false;
        if ($request->has('id')) {
            DB::table('users')->where('id', $request->id)->delete();
            $isDeleteSuccess = true;
        }
        $request->session()->put('isDeleteSuccess', $isDeleteSuccess);
        return redirect('listUser');
    }

    public function getEditUser(Request $request)
    {
        if ($request->has('id')) {
            $id = $request->id;
            $user = DB::table('users')->where('id', $id)->first();
            return view('admin.users.editUser', ['user' => $user]);
        } else {
            return redirect('listUser');
        }
        
    }

    public function editUser(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $validatePassword = $request->validatePassword;
        $user = (object) [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'validatePassword' => $validatePassword
        ];
        $success = false;
        if ($password == $validatePassword && $password != null) {
            $password = Hash::make($request->password);
            
            // DB::table('users')->where('id', $id)->update(['name' => $name, 'email' => $email,'password' => $password]);
            $success = true;
        } else {
            $success = false;
        }
        return view('admin.users.editUser', ['success' => $success, 'id' => $id, 'user' => $user]);
    }
}
