<?php

namespace App\Http\Livewire\Videos;

use App\Models\Videos\Video;
use Livewire\Component;

class VideoPlayer extends Component
{
    public $video_items;
    public $active_video_number = 1;
    public $active_video;

    public function mount(Video $video)
    {
        $this->video = $video;
        $this->video_items = $video->getMedia();
        $this->active_video = $this->video_items[0] ?? null;
    }

    public function render()
    {
        return view('livewire.videos.video-player');
    }

    public function setActiveVideo($video_number)
    {
        $this->active_video_number = $video_number;
        $this->active_video = $this->video_items[$video_number - 1];
        $this->dispatchBrowserEvent('active_video_changed');
    }
}
