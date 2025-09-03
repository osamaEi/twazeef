<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Calendar;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function index()
    {
        $companyId = Auth::id();
        $meetings = Meeting::forCompany($companyId)
            ->with(['creator', 'application', 'calendarEvent'])
            ->orderBy('scheduled_date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        return view('meetings.index', compact('meetings'));
    }

    public function create()
    {
        return view('meetings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'platform' => 'required|in:zoom,teams,meet,in_person',
            'scheduled_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'nullable|string|max:255',
            'attendees' => 'nullable|string',
        ]);

        $meetingData = [
            'title' => $request->title,
            'description' => $request->description,
            'platform' => $request->platform,
            'scheduled_date' => $request->scheduled_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'location' => $request->location,
            'created_by' => Auth::id(),
            'company_id' => Auth::id(),
            'application_id' => $request->application_id,
        ];

        // Generate meeting link based on platform
        if ($request->platform !== 'in_person') {
            $meetingData['meeting_link'] = $this->generateMeetingLink($request->platform);
            $meetingData['meeting_id'] = $this->generateMeetingId();
        }

        // Process attendees
        if ($request->attendees) {
            $attendees = array_map('trim', explode(',', $request->attendees));
            $meetingData['attendees'] = array_map(function ($email) {
                return ['email' => $email, 'status' => 'invited'];
            }, $attendees);
        }

        $meeting = Meeting::create($meetingData);

        // Create calendar event
        $calendarEvent = Calendar::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->scheduled_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'type' => 'meeting',
            'location' => $request->location,
            'created_by' => Auth::id(),
            'company_id' => Auth::id(),
            'application_id' => $request->application_id,
        ]);

        // Link meeting to calendar event
        $meeting->update(['calendar_event_id' => $calendarEvent->id]);

        return redirect()->route('meetings.index')->with('success', 'تم إنشاء الاجتماع بنجاح');
    }

    public function show(Meeting $meeting)
    {
        $meeting->load(['creator', 'application', 'calendarEvent']);
        return view('meetings.show', compact('meeting'));
    }

    public function edit(Meeting $meeting)
    {
        return view('meetings.edit', compact('meeting'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'platform' => 'required|in:zoom,teams,meet,in_person',
            'scheduled_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'nullable|string|max:255',
        ]);

        $meeting->update($request->all());

        // Update calendar event if exists
        if ($meeting->calendarEvent) {
            $meeting->calendarEvent->update([
                'title' => $request->title,
                'description' => $request->description,
                'event_date' => $request->scheduled_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'location' => $request->location,
            ]);
        }

        return redirect()->route('meetings.index')->with('success', 'تم تحديث الاجتماع بنجاح');
    }

    public function destroy(Meeting $meeting)
    {
        // Delete associated calendar event
        if ($meeting->calendarEvent) {
            $meeting->calendarEvent->delete();
        }

        $meeting->delete();
        return redirect()->route('meetings.index')->with('success', 'تم حذف الاجتماع بنجاح');
    }

    public function join(Meeting $meeting)
    {
        if ($meeting->status !== 'scheduled') {
            return redirect()->back()->with('error', 'لا يمكن الانضمام لهذا الاجتماع');
        }

        return redirect($meeting->meeting_link);
    }

    public function start(Meeting $meeting)
    {
        $meeting->update(['status' => 'in_progress']);
        return redirect()->back()->with('success', 'تم بدء الاجتماع');
    }

    public function end(Meeting $meeting)
    {
        $meeting->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'تم إنهاء الاجتماع');
    }

    private function generateMeetingLink($platform)
    {
        $meetingId = $this->generateMeetingId();

        $links = [
            'zoom' => "https://zoom.us/j/{$meetingId}",
            'teams' => "https://teams.microsoft.com/l/meetup-join/{$meetingId}",
            'meet' => "https://meet.google.com/{$meetingId}",
        ];

        return $links[$platform] ?? null;
    }

    private function generateMeetingId()
    {
        return strtoupper(substr(md5(uniqid()), 0, 10));
    }
}
