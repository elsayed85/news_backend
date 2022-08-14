<div class="search_form">
    <form wire:submit.prevent="search">
        <input type="text" name="search" placeholder="اكتب هنا واضغط Enter" wire:model="query_text" wire:change="search">
        <button type="submit">
            <i class="icon-search"></i>
        </button>
    </form>

    @if ($query_text != '')
        <div class="videos_results">
            @forelse ($videos as $video)
                <h4><a href="{{ route('videos.show' , $video) }}" target="_blank">{{ $video->title }}</a></h4>
            @empty
                No Videos Found
            @endforelse
        </div>
    @endif
</div>
