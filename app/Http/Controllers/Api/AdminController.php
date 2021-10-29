<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\AdminCollection;
use App\Http\Resources\Api\AdminResource;
use App\Http\Resources\Api\UserResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function test()
    {
        return 'test';
    }

    //返回用户列表
    public function index()
    {
        //3个用户为一页
        $users = Admin::paginate(3);
        return new AdminCollection($users);
//        return UserResource::collection($users);
        //这里不能用$this->success(UserResource::collection($users))
//否则不能返回分页标签信息
    }

    //返回单一用户信息
    public function show(Admin $admin)
    {
        return $this->success(new AdminResource($admin));
    }


    //返回当前登录用户信息
    public function me(Request $request)
    {
//        $user = Auth::user();
        $user = $request->user();
        return $this->success(new UserResource($user));
    }


}
