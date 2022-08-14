   <div class="row gap_remove">
       @if ($active_video)
           <div class="col-lg-9">
               <div class="vid-pr">
                   <video id="my-video" class="video-js" controls preload="auto" width="640" height="264"
                       poster="{{ asset($video->thumb) }}" data-setup="{}">
                       <source src="{{ route('video.source', ['video' => $active_video]) }}"
                           type="{{ $active_video->mime_type }}" />
                   </video>
               </div>
               <!--vid-pr end-->
           </div>
           <div class="col-lg-3">
               <div class="playlist_view">
                   <div class="playlist_hd">
                       <h3>الفيديوهات<span> {{ $active_video_number }} / {{ $video_items->count() }}</span></h3>
                       <div class="clearfix"></div>
                   </div>
                   <!--playlist_hd end-->
                   <div class="clearfix"></div>
                   <ul class="videos_lizt mCustomScrollbar" data-mcs-theme="dark">
                       @foreach ($video_items as $item)
                           <li>
                               <div class="vidz_row" wire:click="setActiveVideo({{ $loop->iteration }})">
                                   <span class="vid_num">({{ $loop->iteration }})</span>
                                   <div class="vidz_img">
                                       <a href="#" title="">
                                           <img src="{{ asset($video->thumb) }}" alt="" width="150">
                                       </a>
                                       <span class="watch_later">
                                           <i class="icon-watch_later_fill"></i>
                                       </span>
                                   </div>
                                   <!--vidz_img end-->
                                   <div class="video_info">
                                       <h3><a href="#" title="">فيديو {{ $loop->iteration }}</a></h3>
                                   </div>
                               </div>
                               <!--vidz_row end-->
                           </li>
                       @endforeach
                   </ul>
                   <!--videos_lizt end-->
               </div>
               <!--playlist_view end-->
           </div>
       @endif
   </div>
