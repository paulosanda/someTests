<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyLog;
use App\Http\Requests\DailyLogsRequest;
use App\Events\DailyLogCreated;

class DailyLogsController extends Controller
{
    public function store(DailyLogsRequest $request)
    {

        $user_id = Auth::user()->id;
        $log = new DailyLog;
        $log->create([
            'user_id' => $user_id,
            'log' => $request->log,
            'day' => $request->day,
        ]);

        event(new DailyLogCreated($log));

        return response()->json([
            'log' => $log->log,
            'day' => $log->day
        ]);
    }

    public function update($id, Request $request)
    {
        DailyLog::where('id', $id)->update(['log' => $request->log]);
    }

    public function destroy(DailyLog $id)
    {
        $this->authorize('delete', $id);
        $id->delete();
    }
}
