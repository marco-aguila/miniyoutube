<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Video;
use App\Comment;

class VideoController extends Controller
{
    public function create_video()
    {
        return view('video.createVideo');
    }
}
