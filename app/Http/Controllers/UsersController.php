<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\user;
class UsersController extends Controller
{
    //对未登录用户进行限制只允许看show页面，使用auth中间键
    public function __construct()
    {
        $this->middleware('auth',['except' => ['show']]);
    }
    //
    public function show(User $user){
        return view('users.show', compact('user'));
    }
    public function update(UserRequest $request, User $user, ImageUploadHandler $uploader){
        //dd($request->all());
        $this->authorize('own', $user);
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
        $this->authorize('own', $user);
        return view('users.edit', compact('user'));
    }
}
