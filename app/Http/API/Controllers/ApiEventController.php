<?php

namespace App\Http\API\Controllers;

use App\Http\API\Requests\StoreEventRequest;
use App\Http\API\Requests\UpdateEventRequest;
use App\Http\API\Resources\EventCollection;
use App\Http\API\Resources\EventResource;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiEventController extends Controller
{

    public function index(Request $request): EventCollection
    {
        if (!$request->has(['start', 'end_event'])) {
            $events = Event::where('user_id', Auth::user()->getAuthIdentifier())->get();
        } else {
            $events = Event::where('start_event', '>=', $request->start)
                ->where('end_event', '<=', $request->end)
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->get();
        }

        return new EventCollection($events);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create(Request $request)
    {
        $input = $request->only(['title', 'start', 'end']);

        $request_data = [
            'title' => 'required|string|max:100',
            'start' => 'required|date',
            'end' => 'required|date'
        ];

        $validator = Validator::make($input, $request_data);

        // invalid request
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, please check all parameters',
            ]);
        }

        $event = Event::create([
            'title' => $input['title'],
            'start_event' => $input['start'],
            'end_event' => $input['end'],
            'user_id' => Auth::user()->getAuthIdentifier(),
        ]);

        return response()->json([
            'success' => true,
            'data' => new EventResource($event)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Request $request)
    {
        $input = $request->only(['id', 'title', 'start', 'end']);
        $request_data = [
            'id' => ['required', Rule::exists(Event::class)],
            'title' => ['required', 'string', 'max:100'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date']
        ];

        $validator = Validator::make($input, $request_data);

        // invalid request
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, please check all parameters',
            ]);
        }

        $event = Event::where('id', $input['id'])
            ->update([
                'title' => $request['title'],
                'start_event' => $request['start'],
                'end_event' => $request['end'],
            ]);

        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Event::where('id', $request->id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event removed successfully.'
        ]);
    }
}
