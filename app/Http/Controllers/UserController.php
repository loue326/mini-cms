<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        Gate::authorize('manage-categories');

        return view('admin.users.index', [
            'users' => User::orderBy('name')->get(),
        ]);
    }

    public function updateRole(UpdateUserRoleRequest $request, User $user): RedirectResponse
    {
        $user->role = $request->validated()['role'];
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Rôle mis à jour.');
    }
}
