<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\numner;
use Illuminate\Support\Facades\Mail;
use App\Models\Role;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
    
        if ($user->role === null) {
            return redirect('/')->with('error', 'Role not assigned.');
        }
    
        if ($user->role->name !== 'admin') {
            return redirect('/');
        }
    
        return view('admin.dashboard');
    }
    

    public function users()
    {
        if (Auth::user()->role->name !== 'admin') {
            return redirect('/');
        }

        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // public function sendEmail(Request $request)
    // {
    //     if (Auth::user()->role->name !== 'admin') {
    //         return redirect('/');
    //     }

    //     $user = User::find($request->user_id);
    //     Mail::raw($request->message, function ($message) use ($user) {
    //         $message->to($user->email)
    //                 ->subject('Notification');
    //     });

    //     return redirect()->route('admin.users')->with('status', 'Email sent successfully!');
    // }


    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role_id' => 'required|exists:roles,id',
    ]);

    User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role_id' => $validatedData['role_id'],
    ]);

    return redirect()->route('admin.users')->with('status', 'User created successfully!');
}

public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'role_id' => 'required|exists:roles,id',
    ]);

    $user->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'role_id' => $validatedData['role_id'],
        'password' => $validatedData['password'] ? Hash::make($validatedData['password']) : $user->password,
    ]);

    return redirect()->route('admin.users')->with('status', 'User updated successfully!');
}


public function createUserForm()
    {
        $roles = Role::all();
        return view('admin.create_user', compact('roles'));
    }
    public function editUser(User $user)
    {
        if (Auth::user()->role->name !== 'admin') {
            return redirect('/');
        }

        $roles = Role::all();
        return view('admin.edit_user', compact('user', 'roles'));
    }

    public function deleteUser(User $user)
    {
        if (Auth::user()->role->name !== 'admin') {
            return redirect('/');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('status', 'User deleted successfully!');
    }

    public function sendEmail(Request $request)
    {
        if (Auth::user()->role->name !== 'admin') {
            return redirect('/');
        }

        $user = User::find($request->user_id);

        Mail::raw($request->message, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Notification');
        });

        EmailLog::create([
            'user_id' => Auth::id(),
            'receiver_name' => $user->name,
            'receiver_email' => $user->email,
            'message' => $request->message,
        ]);

        return redirect()->route('admin.users')->with('status', 'Email sent successfully!');
    }

    public function emailLogs()
    {
        if (Auth::user()->role->name !== 'admin') {
            return redirect('/');
        }

        $emailLogs = EmailLog::with('user')->get();
        return view('admin.email_logs', compact('emailLogs'));
    }

}