<?php

namespace App\Http\Controllers;

use App\Http\API\Requests\StoreEventRequest;
use App\Http\API\Requests\UpdateEventRequest;
use App\Http\API\Resources\EventCollection;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('calendar');
    }
}
