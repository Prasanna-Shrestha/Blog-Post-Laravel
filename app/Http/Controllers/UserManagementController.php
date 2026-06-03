<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserIsActive;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $users = User::with(['activeStatus'])->latest();
    
        if ($request->status === 'active') {
            $users->whereHas('activeStatus', fn($q) => $q->where('is_active', true))
                ->orWhereDoesntHave('activeStatus'); // no row = active by default
        } elseif ($request->status === 'inactive') {
            $users ->whereHas('activeStatus', fn($q) => $q->where('is_active', false));
        }

        return view('manageusers', compact('users'));
    }
    public function toggle(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot deactivate your own account.');
        }
        // firstOrCreate handles the edge case where the row doesn't exist yet
        $status = UserIsActive::firstOrCreate(
            ['user_id'   => $user->id],
            ['is_active' => true]
        );

        $status->update(['is_active' => !$status->is_active]);

        $label = $status->is_active ? 'activated' : 'deactivated';

        return back()->with('status', "User \"{$user->username}\" has been {$label}.");
    }
}
