<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getData()
    {
        $data   =   Contact::all();

        return response()->json([
            'contacts'  =>  $data
        ]);
    }
    public function store(ContactRequest $request)
    {
        $data   =   $request->all();
        Contact::create($data);

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới liên hệ thành công!'
        ]);
    }
    public function destroy($id)
    {
        Contact::find($id)->delete();

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã xoá liên hệ thành công!'
        ]);
    }
    public function update(Request $request)
    {
        $data   = $request->all();
        Contact::find($request->id)->update($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã cập nhật liên hệ thành công!'
        ]);
    }
    public function getTotalContactsToday()
    {
        $totalContactsToday = Contact::whereDate('created_at', now()->toDateString())->count();
    
        return response()->json([
            'status' => true,
            'total_contacts_today' => $totalContactsToday,
            'message' => 'Tổng số lượng góp ý hôm nay'
        ]);
    }
    
}
