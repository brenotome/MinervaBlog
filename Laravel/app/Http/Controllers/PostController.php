<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;
use LaravelLegends\PtBrValidator\Validator;

use App\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    //Criar um post (Somente para o Blogger)**Falta Atualizar
    public function createPost(PostRequest $request){

        if(!Storage::exists('PostPhotos/'))
            Storage::makeDirectory('PostPhotos/',0775,true);

        $post = new Post;

<<<<<<< HEAD
        $post->conteudo = $request->conteudo;
        $post->title = $request->title;
        $post->user_id = $request->user_id;

        //Salvando a foto
        $image = base64_decode($request->photos);
        $imgName = uniqid().'.png';
        $path = storage_path('app/PostPhotos/'.$imgName);
        file_put_contents($path,$image);
        $post->photos= $imgName;
=======
        $post->title = $request->title;
        $post->text = $request->text;
        // $post->user_id = $request->user_id;
        //Salvando a foto
        $image = base64_decode($request->image);
        $imgName = uniqid();
        $path = storage_path('app/PostPhotos/'.$imgName);
        file_put_contents($path,$image);
        $post->image= $imgName;
>>>>>>> master

        $post->save();

        return response()->json([$post]);
    }

    //Listas todos os Post(Todos)
    public function listPost(){
        return Post::all();
    }

    //Procurar um unico Post(Todos)    this.router.navigate([`post/${id}`]);

    public function showPost($id){

        $post = Post::findOrFail($id);
        $path = storage_path('app/PostPhotos/'.$post->image);
        // $post->image = download$path;

        if($post){
            return response()->success($post);
        }else{
            $data = "Post nao encontrado,verifique o id novamente";
            return response()->error($data,400);
        }
    }

    //Atualizar um Post (Somente para o Blogger)**Falta atualizar
    public function updatePost(PostRequest $request,$id){

        $post = Post::findOrFail($id);

        if($request->conteudo){
            $post->conteudo = $request->conteudo;
        }
        if($request->user_id){
            $post->user_id = $request->user_id;
        }
        if($request->title){
            $post->title = $request->title;
        }

        $post->save();

        return response()->json([$post]);
    }

    //Deletar o Post(Somente o Blogger)
    public function deletePost($id){
        Post::destroy($id);
        return response()->json(['Post deletado']);
    }

}
