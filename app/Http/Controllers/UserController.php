<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    public function index() {
        return view('user.index');
    }

    public function update(UserRequest $request) {
        $user = User::find($request->id);
        
        if($request->image) {
            $file = $request->file('image');
            $image = $file->openFile()->fread($file->getSize());
            $user->update([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'mobile_number' => $request->mobile_number,
                'avatar' => $image
            ]);
        } else {
            $user->update([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'mobile_number' => $request->mobile_number
            ]);
        }

        return redirect('/user')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated your profile.
                            </div>');
    }
}
