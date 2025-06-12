<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total admin
        $totalAdmin = User::where('role', 'admin')->count();

        // Hitung total user
        $totalUser = User::where('role', 'user')->count();

        // Kirim data ke view 'admin.dashboard'
        return view('admin.dashboard', compact('totalAdmin', 'totalUser'));
    }
}
