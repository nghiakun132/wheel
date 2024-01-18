<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Admin::where('role', 'store')->get();

        return view('admin.store.index', compact('stores'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|unique:admins,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ], [
            'name.required' => 'Tên cửa hàng không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được để trống',
            'password_confirmation.same' => 'Xác nhận mật khẩu không đúng',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 400);
        }

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'store',
        ]);

        Reward::insert([
            [
                'shop_name' => $request->name,
                'reward_name' => 'Voucher',
                'reward_quantity' => 10,
                'images' => 'image/voucher.png',
            ],
            [
                'shop_name' => $request->name,
                'reward_name' => 'Sticker',
                'reward_quantity' => 10,
                'images' => 'image/sticker.png',
            ],
            [
                'shop_name' => $request->name,
                'reward_name' => 'Móc khóa',
                'reward_quantity' => 10,
                'images' => 'image/mockhoa.png',
            ],
    
            [
                'shop_name' => $request->name,
                'reward_name' => 'Pin',
                'reward_quantity' => 10,
                'images' => 'image/pin.png',
            ],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Thêm cửa hàng thành công'
        ], 200);
    }

    public function delete($id)
    {
        Admin::find($id)->delete();

        return redirect()->back();
    }
}
