<?php

namespace App\Http\Controllers;

use App\Models\ConTact;
use Illuminate\Http\Request;

class ConTactController extends Controller
{

    public function create(Request $request)
    {
        $report = Contact::create([
            'ho_va_ten'     => $request->ho_va_ten,
            'email'          => $request->email,
            'subject'     => $request->subject,
            'message'     => $request->message,
        ]);
        if ($report) {
            return response()->json([
                'status'   => true,
                'message'  => 'Đã Gửi Thành Công'
            ]);
        } else {
            return response()->json([
                'status'   => false,
                'message'  => 'Gửi Thất Bại'
            ]);
        }
    }
}
