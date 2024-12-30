<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Http\Requests\RegisterMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class MemberController extends Controller
{
    public function getData()
    {
        $data   =   Member::all();

        return response()->json([
            'members'  =>  $data
        ]);
    }
    public function store(MemberRequest $request)
    {
        $data   =   $request->all();
        
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filePath = $file->store('avatars', 'public');
            $data['avatar'] = $filePath;
        }
        
        Member::create($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới thành viên thành công!'
        ]);
    }
    public function updateMember(UpdateMemberRequest $request, $id)
    {
        $member = Member::findOrFail($id);
        $member->user_name = $request->user_name;
        // if ($request->filled('password')) {
        //     $member->password = bcrypt($request->password);
        // }
        //$member->avatar = $request->avatar;
        $member->full_name = $request->full_name;
        $member->subscriber_email = $request->subscriber_email;
        $member->phone_number = $request->phone_number;
        $member->address = $request->address;
        //$member->is_open = $request->is_open;
        $member->save();
        return response()->json(['message' => 'Cập nhật thành công', 'member' => $member]);
    }
    public function destroy($id)
    {
        Member::find($id)->delete();

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã xoá thành viên thành công!'
        ]);
    }
    public function update(Request $request)
    {
        $data   = $request->all();
        Member::find($request->id)->update($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã cập nhật thành viên thành công!'
        ]);
    }
    public function getTotalMembers()
    {
        $totalMembers = Member::count();

        return response()->json([
            'status' => true,
            'total_members' => $totalMembers,
            'message' => 'Tổng số lượng thành viên'
        ]);
    }

    public function dangKy(RegisterMemberRequest $request)
    {
        $check_mail = Member::where('user_name', $request->user_name)->first();
        if ($check_mail) {
            return response()->json([
                'status' => false,
                'message' => "Email đã tồn tại trong hệ thống!"
            ]);
        } else {
            $data                   =   $request->all();
            $data['password']       =   bcrypt($request->password);
            Member::create($data);
            return response()->json([
                'status' => true,
                'message' => "Đăng kí tài khoản thành công!"
            ]);
        }
    }
    public function dangNhap(Request $request)
    {
        $check  = Auth::guard('member')->attempt(['user_name' => $request->user_name, 'password' =>  $request->password]);
        if ($check) {
            $user =  Auth::guard('member')->user();
            // if ($user->is_block) {
            //     return response()->json([
            //         'status'    =>  false,
            //         'message'   =>  'Tài khoản của bạn đã bị khoá!'
            //     ]);
            // }
            if ($user->is_open) {
                return response()->json([
                    'status'    =>  true,
                    'token'     => $user->createToken('token')->plainTextToken,
                    'user_name'    => $user->user_name,
                    'message'   =>  'Đã đăng nhập thành công'
                ]);
            } else {
                Auth::guard('member')->logout();
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Tài Khoản đã bị khóa,vui lòng thử lại sau!'
                ]);
            }
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Tài Khoản hoặc mật khẩu không đúng'
            ]);
        }
    }
    public function changePassword(ChangePasswordRequest $request, $id)
    {
        $member = Member::findOrFail($id);
    
        Log::debug('Current Password (input): ' . $request->current_password);
        Log::debug('Stored Password: ' . $member->password);
        
        if (!Hash::check($request->current_password, $member->password)) {
            return response()->json(['message' => 'Mật khẩu hiện tại không đúng.'], 400);
        }
    
        if (Hash::check($request->new_password, $member->password)) {
            return response()->json(['message' => 'Mật khẩu mới không được giống mật khẩu hiện tại.']);
        }
    
        $member->password = Hash::make($request->new_password);
        $member->save();
    
        return response()->json(['message' => 'Đổi mật khẩu thành công.']);
    }
    

    public function kiemTraToken(Request $request)
    {
        $user = $request->user();

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'Token hợp lệ',
                'user' => $user
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Token không hợp lệ hoặc đã hết hạn'
        ]);
    }

    public function updateCurrentUser(Request $request)
    {
        $user = Auth::guard('member')->user();

        if ($user->id != $request->id) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn không có quyền cập nhật thông tin của người khác!'
            ], 403);
        }

        $data = $request->only(['subscriber_email', 'full_name', 'avatar', 'address']);

        $user->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Thông tin của bạn đã được cập nhật thành công!'
        ]);
    }
}
