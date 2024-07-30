<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Models\Video;

class EventsAndListenerController extends Controller
{
    public function getVideo() {
        $video = Video::first();
        event(new VideoViewer($video));
        return view('events&Listener.video')->with('video', $video);
    }
}
