<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Admin;
use App\Rules\FileTypeValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{

    public function manage_admins()
    {
        $pageTitle = 'Admins';
        $type = 'admin';
        
        $users     = Admin::where('type', $type);

        if(request()->search){
            $search     = request()->search;
            $users = $users->where('name', 'like',"%$search%");
        }

        $users     = $users->paginate(getPaginate());
        $emptyMessage   = 'No '.$type.'s found';
        
        
        return view('admin.superadmin.'.$type.'s', compact('pageTitle', 'users', 'emptyMessage', 'type'));
    }
    
    public function manage_withdraw_teams(){
        
        $pageTitle = 'Withdraw Teams';
        $type = 'withdrawteam';
        
        $users     = Admin::where('type', $type);

        if(request()->search){
            $search     = request()->search;
            $users = $users->where('name', 'like',"%$search%");
        }

        $users     = $users->paginate(getPaginate());
        $emptyMessage   = 'No '.$type.'s found';
        
        return view('admin.superadmin.admins', compact('pageTitle', 'users', 'emptyMessage', 'type'));
        
        
    }
    
    public function manage_deposit_teams(){
        
        $pageTitle = 'Deposit Teams';
        $type = 'depositteam';
        
        $users     = Admin::where('type', $type);

        if(request()->search){
            $search     = request()->search;
            $users = $users->where('name', 'like',"%$search%");
        }

        $users     = $users->paginate(getPaginate());
        $emptyMessage   = 'No '.$type.'s found';
        
        return view('admin.superadmin.admins', compact('pageTitle', 'users', 'emptyMessage', 'type'));
    }
    
    public function manage_agents(){
        
        $pageTitle = 'Agents';
        $type = 'agent';
        
        $users     = Admin::where('type', $type);

        if(request()->search){
            $search     = request()->search;
            $users = $users->where('name', 'like',"%$search%");
        }

        $users     = $users->paginate(getPaginate());
        $emptyMessage   = 'No '.$type.'s found';
        
        return view('admin.superadmin.admins', compact('pageTitle', 'users', 'emptyMessage', 'type'));
    }
    
    
    public function store(Request $request, $type){
        
         $request->validate([
            'name' => 'required|string',
            'email'                 => 'required|unique:admins',
            'username'              => 'required|string|regex:/\w*$/|max:255|unique:admins',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
           ]);
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->type = $type;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();
        $notify[] = ['success', ucfirst($type).' Added Successfully'];
        return back()->withNotify($notify);
        
    }
    
     public function delete($id){
        $admin =  Admin::findOrFail($id);
        $admin->delete();
        $notify[] = ['success', 'Deleted Successfully'];
        return back()->withNotify($notify);
     }


}
