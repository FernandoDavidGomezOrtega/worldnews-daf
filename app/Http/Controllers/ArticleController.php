<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Article;
use App\DeletedArticle;
use App\Section;
use App\User;

class ArticleController extends Controller
{
    public function __construct(){
//        $this->middleware('auth');
    }

    public function create(){
//        $sections = Section::orderBy('id', 'desc');
        $sections = DB::table('sections')
            ->orderBy('id')
            ->get();
//        dd($sections);

        return view('article.create', [
            'sections' => $sections
        ]);
    }

    public function save(Request $request){
//        dd($request);

        // validacion
        $validate = $this->validate($request, [
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'section' => 'required|string',
            'keywords' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            // 'image_path' => 'required|mimes:jpg,jpeg,png,gif',
            'image_path' => 'required|image',
            'text' => 'required|string',
        ]);


        // recoger los datos
        $title = $request->input('title');
        $subtitle = $request->input('subtitle');
        $section = $request->input('section');
        $keywords = $request->input('keywords');
        $slug = $request->input('slug');
        $image_path = $request->file('image_path');
        $text = $request->input('text');


        //asignar valores al objeto
        // $user = \Auth::user(); si no funciona del otro modo hay que poner la barra delante de Auth
        $user = Auth::user();
        $article = new Article();
        $article->author = $user->id;
        $article->edited_by = null;
        $article->section_id = $section;
        $article->title = $title;
        $article->sub_title = $subtitle;
        $article->text = $text;
        $article->keywords = $keywords;
        $article->slug = $slug;
        $article->state = 'review';

        // subir fichero
        if ($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $article->image_path = $image_path_name;
        }

        $article->save();
        return redirect()->route('home')->with([
            'message' => 'El Artículo se ha enviado para revisión'
        ]);
    }

    public function getArticleImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){
        $publishedArticle = Article::find($id);
//        dd($publishedArticle);

        return view('article.detail', [
            'publishedArticle' => $publishedArticle
        ]);
    }

    public function delete($id){
        $user = \Auth::user();
        $article = Article::find($id);

//        $comments = Comment::where('Article_id', $id)->get();
//        $likes = Like::where('Article_id', $id)->get();
//        $ratings = Rating::where('Article_id', $id)->get();

        if ($user  && $user->usertype != 'user'){


            // eliminar ficheros de imagen del storage
            Storage::disk('images')->delete($article->image_path);

            // eliminar registro de Articlee en db
            $article->delete();
            $message = array('message' => 'El artículo se ha eliminado correctamente');

        } else{
            $message = array('message' => 'El artículo NO se ha eliminado');
        }

        return redirect()->route('home')->with($message);
    }

    public function edit($id){
        $user = \Auth::user();
        $article = Article::find($id);
        $sections = DB::table('sections')
            ->orderBy('id')
            ->get();

        if (($user && $user->usertype != 'journalist')  || ($user && $user->id == $article->author)){
//                    dd($sections);

            return view('article.edit', [
                'article' => $article,
                'sections' => $sections
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    public function update(Request $request){

//                dd($request);

        // validacion
        $validate = $this->validate($request, [
            'id' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'section' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'image_path' => 'image',
            'text' => 'required|string',
            'keywords' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);

        // recoger los datos
        $id = $request->input('id');
        $author = $request->input('author');
        $section = $request->input('section');
        $title = $request->input('title');
        $subtitle = $request->input('subtitle');
        $image_path = $request->file('image_path');
        $text = $request->input('text');
        $keywords = $request->input('keywords');
        $slug = $request->input('slug');
        $state = $request->input('state');

//        dd($title);
        $user = Auth::user();

//        obtenemos el articulo antiguo
        $originalArticle = Article::find($id);


//        asignamos valores al artículo que se guardará en `deleted_articles`
        $deletedArticle = new DeletedArticle();
        $deletedArticle->article_id = $originalArticle->id;
        $deletedArticle->edited_by = $user->id;
        $deletedArticle->section_id = $originalArticle->section_id;
        $deletedArticle->title = $originalArticle->title;
        $deletedArticle->sub_title = $originalArticle->sub_title;
        $deletedArticle->image_path = $originalArticle->image_path;
        $deletedArticle->text = $originalArticle->text;
        $deletedArticle->keywords = $originalArticle->keywords;
        $deletedArticle->slug = $originalArticle->slug;
        $deletedArticle->state = $originalArticle->state;

//        dd($deletedArticle);

        //        guardamos el $deletedArticle
        $deletedArticle->save();
//        die();

        // actualizar objeto Article
        $article = Article::find($id);
        $article->author = $author;
        $article->edited_by = $user->id;
        $article->section_id = $section;
        $article->title = $title;
        $article->sub_title = $subtitle;
        $article->text = $text;
        $article->keywords = $keywords;
        $article->slug = $slug;
        $article->state = $state;
        $article->editor_comments = $originalArticle->editor_comments;
//        $article->published_at = $originalArticle->published_at;

        // subir fichero
        if ($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $article->image_path = $image_path_name;
        } else{
            $article->image_path = $originalArticle->image_path;
        }

//        dd($article);

        // actualizar registro
        $article->update();
        return redirect()->route('article.detail', ['id' => $id])
            ->with(['message' => 'Artículo actualizado con éxito']);
    }
}



