<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventsRequest;
use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function getData()
    {
        $data   =   Events::with(['association:id,registrant_name,company_name'])->get();
        //$data   =   Events::all();
        return response()->json([
            'events'  =>  $data
        ]);
    }
    public function store(EventsRequest $request)
    {
        $data   =   $request->all();
        Events::create($data);

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới sự kiện thành công!'
        ]);
    }
    public function destroy($id)
    {
        Events::find($id)->delete();

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã xoá sự kiện thành công!'
        ]);
    }
    public function update(Request $request)
    {
        $data   = $request->all();
        Events::find($request->id)->update($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã cập nhật sự kiện thành công!'
        ]);
    }
    public function getTotalEvents()
    {
        $totalEvents = Events::count();

        return response()->json([
            'status' => true,
            'total_events' => $totalEvents,
            'message' => 'Tổng số lượng sự kiện'
        ]);
    }
    public function getLatestEvents()
    {
        $latestEvents = Events::orderBy('event_date', 'desc')->take(3)->get();

        return response()->json($latestEvents);
    }
    public function getEventsIsHappening()
    {
        $ongoingEvents = Events::with(['association:id,registrant_name,company_name'])
            ->where('event_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get();

        return response()->json([
            'ongoing_events' => $ongoingEvents,

        ]);
    }
    public function getUpcomingEvents()
    {
        $upcomingEvents = Events::where('event_date', '>', now())->get();

        return response()->json([
            'upcoming_events' => $upcomingEvents,
        ]);
    }
    public function getEventsByOrganizer($organizer_id)
    {
        $events = Events::where('organizer_id', $organizer_id)
        ->with(['association:id,registrant_name'])
        ->get();
        if ($events->isEmpty()) {
            return response()->json(['message' => 'Không tìm thấy sự kiện nào cho người tổ chức này']);
        }
        return response()->json($events);
    }
}
