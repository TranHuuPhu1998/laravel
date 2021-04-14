<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\User;
use App\Http\Resources\UserResource;

use Validator;

class UserController extends Controller
{
    //
    public function getUsers(Request $request){
        return new UserResource(User::all());
    }

    public function deleteUser($id) {
        $user = User::find($id);

        $user->delete();

        return response()->json('successfully deleted');
    }

    public function updateUser(Request $request , $id){

        $user = User::find($id);

        $user->name = $request->name;   
        $user->email = $request->email;
        $user->permission = $request->permission;
        $user->position = $request->position;
        $user->status = $request->status;
        $user->password = bcrypt($request->password);
        $user->isAdmin = $request->isAdmin; 

        $result = $user->save();

        return  $user;
    }

    public function createUser(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'permission' => 'required|integer',
            'position' => 'required|integer',
            'status' => 'string',
        ]);
 
        if ($validator->fails()) {
            return response()->json([
                'status' => 'fails',
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors()->toArray(),
            ]);
        }
 
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'permission' => $request->permission,
            'status' => $request->status,
            'password' => bcrypt($request->password)
        ]);
 
        $user->save();
        
        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);
    }
}
