<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Blog;
class DeleteUserBlogs
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserDeleted $event): void
    {
        $user = $event->user;
        Blog::where('user_email', $user->email)->delete();
    }
}
