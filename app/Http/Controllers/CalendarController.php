<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $companyId = Auth::id();
        $events = Calendar::forCompany($companyId)
            ->upcoming()
            ->with(['creator', 'application'])
            ->get();

        return view('calendar.index', compact('events'));
    }

    public function create()
    {
        return view('calendar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'type' => 'required|in:meeting,interview,deadline,personal,other',
            'location' => 'nullable|string|max:255',
        ]);

        $event = Calendar::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'type' => $request->type,
            'location' => $request->location,
            'created_by' => Auth::id(),
            'company_id' => Auth::id(),
            'application_id' => $request->application_id,
        ]);

        return redirect()->route('calendar.index')->with('success', 'تم إنشاء الحدث بنجاح');
    }

    public function show(Calendar $calendar)
    {
        $calendar->load(['creator', 'application', 'meetings']);
        return view('calendar.show', compact('calendar'));
    }

    public function edit(Calendar $calendar)
    {
        return view('calendar.edit', compact('calendar'));
    }

    public function update(Request $request, Calendar $calendar)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'type' => 'required|in:meeting,interview,deadline,personal,other',
            'location' => 'nullable|string|max:255',
        ]);

        $calendar->update($request->all());

        return redirect()->route('calendar.index')->with('success', 'تم تحديث الحدث بنجاح');
    }

    public function destroy(Calendar $calendar)
    {
        $calendar->delete();
        return redirect()->route('calendar.index')->with('success', 'تم حذف الحدث بنجاح');
    }

    public function getEvents(Request $request)
    {
        $companyId = Auth::id();
        $start = $request->get('start');
        $end = $request->get('end');

        $events = Calendar::forCompany($companyId)
            ->whereBetween('event_date', [$start, $end])
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->event_date->format('Y-m-d') . 'T' . $event->start_time->format('H:i:s'),
                    'end' => $event->end_time ?
                        $event->event_date->format('Y-m-d') . 'T' . $event->end_time->format('H:i:s') :
                        $event->event_date->format('Y-m-d') . 'T' . $event->start_time->addHour()->format('H:i:s'),
                    'color' => $this->getEventColor($event->type),
                    'description' => $event->description,
                    'location' => $event->location,
                ];
            });

        return response()->json($events);
    }

    private function getEventColor($type)
    {
        $colors = [
            'meeting' => '#4caf50',
            'interview' => '#2196f3',
            'deadline' => '#ff9800',
            'personal' => '#9c27b0',
            'other' => '#607d8b',
        ];

        return $colors[$type] ?? '#607d8b';
    }
}
