<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Services\UserService;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(): Response
    {
        return Inertia::render('Users/Index', ['users' => UserResource::collection($this->userService->getUsers(request('search')))]);
    }

    public function create(): Response
    {
        return Inertia::render('Users/Create');
    }

    public function store(UserRequest $request)
    {
        $this->userService->store($request);

        return redirect()->route('users.index');
    }

    public function edit($id): Response
    {
        return Inertia::render('Users/Edit', ['user' => $this->userService->findUserById($id)]);
    }

    public function update(Request $request, $id)
    {
        $user = $this->userService->findUserById($id);
        $user->update($request->all());
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->userService->findUserById($id)->delete();

        return redirect()->back();
    }
}
