<?php

namespace CleaniqueCoders\Attendance\Http\Controllers\Api;

use CleaniqueCoders\Attendance\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function timeIn(Request $request)
    {
        abort_if(! auth()->user(), 401);

        (new \CleaniqueCoders\Attendance\Adapters\ApiAdapter(auth()->user(), now()))->timeIn();

        return response()->json([
            'message' => 'Time in successfully logged.',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function timeOut(Request $request)
    {
        abort_if(! auth()->user(), 401);

        (new \CleaniqueCoders\Attendance\Adapters\ApiAdapter(auth()->user(), now()))->timeOut();

        return response()->json([
            'message' => 'Time out successfully logged.',
        ]);
    }
}
