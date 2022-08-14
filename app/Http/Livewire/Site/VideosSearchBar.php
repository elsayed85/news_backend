<?php

namespace App\Http\Livewire\Site;

use App\Models\Videos\Video;
use Livewire\Component;

class VideosSearchBar extends Component
{
    public $query_text;
    public $videos  = [];

    public function render()
    {
        return view('livewire.site.videos-search-bar');
    }

    public function search()
    {
        $this->videos = Video::where('title', 'like', '%' . $this->query_text . '%')
            ->take(3)
            ->get();
    }
}
