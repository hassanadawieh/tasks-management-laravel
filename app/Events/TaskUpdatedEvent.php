<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function broadcastOn()
    {
        return ['my-channel'];
    }

    public function broadcastAs()
    {
        return 'task-updated';
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->task->id,
            'description' => $this->task->description,
            'status' => $this->task->status,
            'user_id' => $this->task->user_id,
            'created_at' => $this->task->created_at->toDateTimeString(),
            'updated_at' => $this->task->updated_at->toDateTimeString(),
        ];
    }
}
