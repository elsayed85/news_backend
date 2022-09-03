<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DownloadMediaController extends Controller
{
    public function show(Media $mediaItem)
    {
        return response()->download($mediaItem->getPath(), $mediaItem->file_name);
    }
}
