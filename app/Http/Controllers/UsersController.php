<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\user;
class UsersController extends Controller
{
    //
    public function show(User $user){
        return view('users.show', compact('user'));
    }
    public function update(UserRequest $request, User $user, ImageUploadHandler $uploader){
        //dd($request->all());
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id,416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
    public function edit(User $user){
        return view('users.edit', compact('user'));
    }
}
