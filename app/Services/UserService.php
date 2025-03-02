<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
    }

    public function getUsers(?string $search = null): LengthAwarePaginator
    {
        $query = $this->user->query();
        if ($search) {
            $query->where('name', 'like', "%$search%");
        }
        return $query->latest()->paginate(10);
    }

    public function findUserById($id): User
    {
        return $this->user->find($id);
    }
}
