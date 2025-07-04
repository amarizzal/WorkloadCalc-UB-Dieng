<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\LaporanTindakanPerawat;

class LaporanTindakanUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $laporan;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\LaporanTindakanPerawat $laporan
     * @return void
     */
    public function __construct(LaporanTindakanPerawat $laporan)
    {
        $this->laporan = $laporan;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
