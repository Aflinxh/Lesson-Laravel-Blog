<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMyAccountRequest;
use App\Http\Requests\UpdateMyPasswordRequest;
use App\Models\Post;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Can;

class DashboardAccountController extends Controller
{
    public function myAccount()
    {
        return view('dashboard.accounts.myaccount', [
            'title' => 'My Account',
            'user' => auth()->user()
        ]);
    }

    public function updateMyAccount(UpdateMyAccountRequest $request)
    {
        $user = auth()->user();

        $user->name = $request['name'];
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->save();

        return redirect()->route('dashboard.myaccount')->with('success', 'Account updated successfully!');
    }

    public function updateMyPassword(UpdateMyPasswordRequest $request)
    {
        // dd('update password');

        $user = auth()->user();

        if (!Hash::check($request->password1, $user->password)) {
            return redirect()->route('dashboard.myaccount')->with('error', 'Current password is incorrect!');
        }

        $user->password = Hash::make($request->password2);
        $user->save();

        return redirect()->route('dashboard.myaccount')->with('success', 'Password updated successfully!');
    }

    public function eraseAllData(Request $request)
    {
        // dd('erase');

        $user = auth()->user();

        if ($request->password1 != $request->password2) {
            return redirect()->route('dashboard.myaccount')->with('error', 'Password confirmation does not match!');
        }
        if (!Hash::check($request->password1, $user->password)) {
            return redirect()->route('dashboard.myaccount')->with('error', 'Current password is incorrect!');
        }

        $data = Post::where('user_id', $user->id);
        $data->delete();

        return redirect()->route('dashboard.myaccount')->with('success', 'All data erased successfully!');
    }

    public function destroy(Request $request) {
        // dd('delete account');
        
        $user = auth()->user();

        if ($request->password1 != $request->password2) {
            return redirect()->route('dashboard.myaccount')->with('error', 'Password confirmation does not match!');
        }
        if (!Hash::check($request->password1, $user->password)) {
            return redirect()->route('dashboard.myaccount')->with('error', 'Current password is incorrect!');
        }

        if ($user->posts->count() > 0) {
            return back()->with('error', 'You must delete all your posts before deleting your account!');
        }

        $user->delete();

        return redirect()->route('dashboard.myaccount')->with('success', 'Account deleted successfully!');
    }
}
