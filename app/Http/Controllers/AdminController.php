<?php

namespace App\Http\Controllers;

use App\Exports\ExportSurvey;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        $stores =Admin::where('name', '<>', config('app.admin.name'))->get();

        return view('admin.index', compact('stores'));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($credentials)) {
            if(auth()->guard('admin')->user()->role == 'admin'){
                return redirect()->route('admin.index');
            }
            
            return redirect()->route('dashboard');
        }

        return redirect()->route('admin.login')->with('error', 'Email hoặc mật khẩu không đúng');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect()->route('admin.login');
    }

    public function export(Request $request)
    {

       
        $fileName = 'survey_' . date('d-m-Y') . '.xlsx';

        Excel::store(
            new ExportSurvey($request->all()),
            "report/{$fileName}",
            'public'
        );

        return response()->download(storage_path("app/public/report/{$fileName}"));
    }

    public function changePassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'new_password_confirmation' => 'required|same:new_password',
        ], [
            'old_password.required' => 'Mật khẩu cũ không được để trống',
            'new_password.required' => 'Mật khẩu mới không được để trống',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
            'new_password_confirmation.required' => 'Xác nhận mật khẩu mới không được để trống',
            'new_password_confirmation.same' => 'Xác nhận mật khẩu mới không đúng',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 400);
        }

        $admin = Admin::find(auth()->guard('admin')->user()->id);

        if (!Hash::check($request->old_password, $admin->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Mật khẩu cũ không đúng'
            ], 400);
        }

        $admin->password = bcrypt($request->new_password);
        $admin->save();

        auth()->guard('admin')->logout();

        return response()->json([
            'status' => true,
            'message' => 'Đổi mật khẩu thành công'
        ], 200);
    }
}
