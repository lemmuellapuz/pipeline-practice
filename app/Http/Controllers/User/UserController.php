<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Filters\ByEmail;
use App\Http\Filters\ByName;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $pipes = [
            new ByEmail($request->email),
            new ByName($request->name),
        ];

        $users = Pipeline::send(User::query())
        ->through($pipes)
        ->thenReturn()
        ->paginate();

        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());

        return response([
            'status' => 'success',
            'message' => 'User created',
            'data' => UserResource::make($user)
        ], 201);
    }

    public function show(User $user)
    {
        return UserResource::make($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'email' => $request->email,
            'name' => $request->name
        ]);

        return response([
            'status' => 'success',
            'message' => 'User has been updated'
        ], 200);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response([
            'status' => 'success',
            'message' => 'User has been deleted'
        ], 200);
    }
}
