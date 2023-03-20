<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    function index()
    {
        return view('login');
    }

    function registration()
    {
        return view('registration');
    }

    function validate_registration(Request $request)
    {
        $request->validate([
            'name'         =>   'required',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6'
        ]);

        $data = $request->all();

        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect('login')->with('success', 'Registration Completed, now you can login');
    }

    function validate_login(Request $request)
    {
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('dashboard');
        }

        return redirect('login')->with('success', 'Login details are not valid');
    }

    function dashboard()
    {
        if (Auth::check()) {
            //$data = auth()->user();
            $data["user"] = auth()->user();
            $data["emp"] = Employee::all();
            return view('index', $data);
            //return view('index')->with('data', $data);
        }

        return redirect('login')->with('success', 'Login First');
    }

    function logout()
    {
        Session::flush();

        Auth::logout();

        return Redirect('login');
    }

    public function accessEmail(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $credits = $user->credits;
        if ($credits > 0) {
            $credits -= 1;
            $user->credits = $credits;
            $user->save();
            return response()->json([
                'email' => $user->email,
                'credits' => $credits
            ]);
        } else {
            return response('Insufficient credits.', 403);
        }
    }
    public function getCredits()
    {
        $credits = User::where('user_id', Auth::user()->id)->value('credits');
        return response()->json(['credits' => $credits]);
    }

    public function downloadData(Request $request)
    {
        $selectedItems = $request->input('selected_items');

        $creditsToDeduct = count($selectedItems);
        DB::table('users')->decrement('credits', $creditsToDeduct);

        return response()->json(['success' => true]);
    }

    public function applyFilter(Request $request)
    {
        DB::table('users')->decrement('credits', 1);
        return response()->json(['success' => true]);
    }
}
