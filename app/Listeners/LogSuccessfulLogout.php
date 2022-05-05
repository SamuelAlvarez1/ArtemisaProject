<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $user = User::find($event->user->id);
        if ($user) {      
        $user->lastLog = date('Y-m-d H:i:s');
        $user->save();
        }
    }
}
