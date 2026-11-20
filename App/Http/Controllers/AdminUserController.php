<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\UserManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function __construct(
        private readonly UserManagementService $userService
    ) {}

    public function index(): View
    {
        $users = $this->userService->getAllUsers();

        return view('admin.users.index', compact('users'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->userService->createUser($request->validated());

        return redirect()->route('admin.users.index')
            ->with('success', 'Akun pengguna baru berhasil dibuat.');
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'role' => ['required', Rule::in([
                User::ROLE_ADMIN,
                User::ROLE_SERVICE_ADVISOR,
                User::ROLE_MECHANIC,
                User::ROLE_CUSTOMER,
            ])],
        ]);

        $this->userService->updateUserRole($user, $validated['role']);

        return redirect()->route('admin.users.index')
            ->with('success', 'Hak akses (role) pengguna berhasil diperbarui.');
    }
}
