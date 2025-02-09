<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserManagementRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index()
    {   
        if (Auth::user()->role == 'operator') {
            return redirect()->route('incoming.items');
        }
        
        return view('user-management/index', [
            'menu' => 'User Manajemen',
            'users' => $this->userRepository->all()
        ]);
    }

    public function store(UserManagementRequest $request)
    {
        try {
            $this->userRepository->create($request->validated());
            return response()->json(['message' => 'User berhasil ditambahkan']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(UserManagementRequest $request, $id)
    {
        try {
            $this->userRepository->update($request->validated(), $id);
            return response()->json(['message' => 'User berhasil diubah']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->userRepository->destroy($id);
            return redirect()->route('user-management')->with('success', 'User berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('user-management')->with('error', $e->getMessage());
        }
    }

    public function lock($id) {
        try {
            $this->userRepository->lock($id);
            return redirect()->route('user-management')->with('success', 'Akses login user berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->route('user-management')->with('error', $e->getMessage());
        }
    }
}
