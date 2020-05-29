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
    public function createVideo()
    {
        return view('video.createVideo');
    }

    
    public function saveVideo(Request $request)
    {
        //validar formulario con los datos que se suber a la BD
        $validateData = $this->validate($request,[
            'title' => 'required|min:5',
            'description'=> 'required',
            'video' => 'mimes:mp4'
        ]);

        $video = new Video();//crea un nuevo modelo 
        $user = \Auth::user();//verificar que el usuario este logeado
        $video->user_id= $user->id;//relacion de llave foranea para asignarle un video a un usuario
        $video->title = $request->input('title');//obtener la informacion y guardarle en las variables correspondientes
        $video->description = $request->input('description');
        //subida de imagen 
        $image = $request->file('image');
        if($image)
        {
            $image_path = time().$image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));
            $video->image = $image_path;
        }
        //subida del video
        $video_file = $request->file('video');
        if($video_file)
        {
            $video_path = time().$video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path, \File::get($video_file));
            $video->video_path = $video_path;
        }
        $video->save();

        return redirect()->route('home')->with(array(
            'message' => 'El video se a subido Correctamente! XD'
        ));
    }

    public function obtenerImagen($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function obtenerVideo($filename)
    {
        $file = Storage::disk('videos')->get($filename);
        return new Response($file, 200);
    }

    public function obtenerVideoDetail($video_id)
    {
        $video = Video::find($video_id);

        return view('video.detail', array(
            'video' => $video
        ));
    }

}
