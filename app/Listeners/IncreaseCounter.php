<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param VideoViewer $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        if (!session()->has('videoVisited_'.$event->video->id)) {
            $this->updateViews($event->video);
            var_dump(session()->has('videoVisited_'.$event->video->id));
        } else {
            return false;
        }
    }

    public function updateViews($video)
    {
        $video->views = $video->views + 1;
        $video->save();

        var_dump($video->id);
        echo $video->id;
        session()->put('videoVisited_'.$video->id, $video->id);
    }
}
