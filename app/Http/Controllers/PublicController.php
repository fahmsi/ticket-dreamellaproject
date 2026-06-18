<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $events = Event::with('tickets')
            ->where('status', 'published')
            ->orderBy('event_date')
            ->take(3)
            ->get();

        return view('home', compact('events'));
    }

    public function events(Request $request)
    {
        $events = Event::with('tickets')
            ->where('status', 'published')
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%'.$request->q.'%'))
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->category))
            ->when($request->filled('date'), fn ($query) => $query->whereDate('event_date', $request->date))
            ->orderBy('event_date')
            ->paginate(9)
            ->withQueryString();

        $categories = Event::whereNotNull('category')->distinct()->pluck('category');

        return view('events.index', compact('events', 'categories'));
    }

    public function show(Event $event)
    {
        abort_unless($event->status === 'published', 404);

        $event->load('tickets');

        return view('events.show', compact('event'));
    }
}
