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

    public function delete($video_id)
    {
        $user = \Auth::user();
        $video = Video::find($video_id);
        $comments = Comment::where('video_id',$video_id)->get();

        if($user && $video->user_id == $user->id)
        {
            // Eliminar comments
            if($comments && count($comments) >= 1)
            {
                foreach($comments as $comment){
                    $comment->delete();
                }
                
            }
           
            // Eliminar Ficheros
            Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);
            // Eliminar Video
            $video->delete();
            $message =array('message' => 'VIDEO Eliminado Con Exito!');
        }else{
            $message =array('message' => 'VIDEO No a podido eliminarse');
        }
        return redirect()->route('home')->with($message);
    }

    public function edit($video_id)
    {   
        
        $user = \Auth::user();
        $video = Video::findOrFail($video_id);
        if($user && $video->user_id == $user->id)
        {   
            return view('video.edit', array('video' => $video));
        }
        else
        {
            return redirect()->route('home');
        }
    }

    public function update($video_id, Request $request)
    {
        //vALIDAR LOS DATOS DEL FORM
        $validate = $this->validate($request,[
            'title' => 'required|min:5',
            'description'=> 'required',
            'video' => 'mimes:mp4'
        ]);

        //OBTENER LOS DATOS DEL FORM Y VALIDAR SI ESTAS LOGEADO
        $user = \Auth::user();
        $video = Video::findOrFail($video_id);
        $video->user_id = $user->id;
        $video->title  = $request->input('title');
        $video->description  = $request->input('description');

          // Eliminar Ficheros Antiguos
          Storage::disk('images')->delete($video->image);
          Storage::disk('videos')->delete($video->video_path);

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

          $video->update();

          return redirect()->route('home')->with(array('message' => 'El video se a ACTUALIZADO Correctamente!' ));
    }

    public function search($search = null, $filter = null)
    {   
        if(is_null($search)){
            $search = \Request::get('search');
            return redirect()->route('videoSearch' , array('search' => $search));
        }

        if(is_null($filter) && \Request::get('filter') && !is_null($search)){
            $filter = \Request::get('filter');
            return redirect()->route('videoSearch' , array('search' => $search, 'filter' => $filter));
        }
        //filtros para la busqueda
        $colum = 'id';
        $order = 'desc';

        if(!is_null($filter)){
            if($filter=='new'){
                $colum = 'id';
                $order = 'desc';
            }
            if($filter == 'old'){
                $colum = 'id';
                $order = 'asc';
            }

            if($filter == 'alfa'){
                 $colum = 'title';
                 $order = 'asc';
            }
        }

        $videos = Video::where('title','LIKE','%'.$search.'%')
            ->orderBy($colum,$order)
            ->paginate(5);//buscar y sacar los videos que CONTENGAN alguna relacion con la busqueda
   
        return view('video.search',array(
            'videos' => $videos,
            'search' => $search      
          ));
    }

}
