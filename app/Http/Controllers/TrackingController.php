<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function totalVisitCount(Request $request)
    {
        $totalVisits = Tracking::sum('visit_count');

        return response()->json([
            'total_visit_count' => $totalVisits,
        ]);
    }
    public function vitsitcountBydate(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        $tracking = Tracking::firstOrCreate(
            ['date' => $date],
            ['visit_count' => 1]
        );
        if (!$tracking->wasRecentlyCreated) {
            $tracking->visit_count++;
            $tracking->save();
        }
        return response()->json([
            'date' => $tracking->date,
            'visit_count' => $tracking->visit_count,
        ]);
    }
    public function latestTracking(Request $request)
    {
        $latestTracking = Tracking::orderBy('date', 'desc')->first();
        if ($latestTracking) {
            return response()->json([
                'date' => $latestTracking->date,
                'visit_count' => $latestTracking->visit_count,
            ]);
        } else {
            return response()->json([
                'message' => 'Không có bản ghi nào.',
            ], 404);
        }
    }
}
