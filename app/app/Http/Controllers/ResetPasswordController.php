<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
// use app\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\User;

class ResetPasswordController extends Controller
{
    /**
     * Create token password reset.
     *
     * @param  ResetPasswordRequest $request
     * @return JsonResponse
     */

    
    // public function sendMail(Request $request)
    // {
    //     $user = User::where('email', $request->email)->firstOrFail();

    //     $passwordReset = PasswordReset::updateOrCreate([
    //         'email' => $user->email,
    //     ], [
    //         'token' => Str::random(60),
    //     ]);

    //     if ($passwordReset) {
    //         $user->notify(new ResetPasswordRequest($passwordReset->token));
    //     }
  
    //     return response()->json([
    //         'message' => 'We have e-mailed your password reset link!'
    //     ]);
        
    // }
    
    public function reset(ResetRequest $request)
    {
        // $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        // if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
        //     $passwordReset->delete();

        //     return response()->json([
        //         'message' => 'This password reset token is invalid.',
        //     ], 422);
        // }
        // $user = User::where('email', $passwordReset->email)->firstOrFail();
        // $updatePasswordUser = $user->update($request->only('password'));
        // $passwordReset->delete();

        // return response()->json([
        //     'success' => $updatePasswordUser,
        // ]);

        $token = $request->input('token');

        if(!$passwordReset = DB::table('password_resets')->where('token',$token)->first()){
            return response([
                'message' => 'Invalid token!'
            ],400);
        }

        if(!$user = User::where('email' , $passwordReset->email)->first()){
            return response([
                'message' => 'user does not exist !'
            ],404);
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();
        return response([
            'message' => 'success'
        ]);
    }
   
    public function forgot(ForgotRequest $request){
        $user = User::where('email', $request->email)->firstOrFail();

        $passwordReset = PasswordReset::updateOrCreate([
            'email' => $user->email,
        ], [
            'token' => Str::random(60),
        ]);

        if ($passwordReset) {
            $user->notify(new ResetPasswordRequest($passwordReset->token));
        }
  
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }


}