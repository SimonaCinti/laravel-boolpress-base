<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {   // get all tags
        $tags = Tag::all();

        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //Collect data from form
        $data = $request->all();
        // dd($data);

        // Validation
        $request->validate($this->ruleValidation());

        // Create post slug
        $data['slug'] = Str::slug($data['title'], '-');
        // dd($data);

        // If img !== null, put image on server

        if(!empty($data['path_img'])){
            $data['path_img'] = Storage::disk('public')->put('images', $data['path_img'] );
        }

        // Save to DB

        $newPost = new Post();
        $newPost->fill($data); //fillable nel Model necessario
        $saved = $newPost->save();

        if ($saved){

            // Check delle tags per la tabella pivot
            if(!empty($data['tags'])) {

                $newPost->tags()->attach($data['tags']);

            }
            return redirect()->route('posts.index');
        } else {
            return redirect()->route('homepage');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('posts.show', compact('post'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {   
        $post = Post::where('slug', $slug)->first();

        $tags = Tag::all();

        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Get data from form 
        $data = $request->all();

        // Validazione dati
        $request->validate($this->ruleValidation());

        // Get post to update

        $post = Post::find($id);

        // Update Slag

        $post['slug'] = Str::slug($data['title'], '-');
        
        // If img changed
        if (!empty($data['path_img'])){
            if (!empty($post['path_img'])){
               Storage::disk('public')->delete($post->path_img); 
            }
            $data['path_img'] = Storage::disk('public')->put('images', $data['path_img']);
        }

        // Update DB
        $updated = $post->update($data); // <-- Necessita del fillable del model

        if ($updated){

            // Check TAGS

            if (!empty($data['tags'])){
                $post->tags()->sync($data['tags']);
            } else {
                $post->tags()->detach();
            }

            return redirect()->route('posts.show', $post->slug);
        } else {
            return redirect()->route('homepage');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $title = $post->title; // per il with
        $image = $post->path_img; // per cancellare image nel db
        $post->tags()->detach(); // rimuovi la relazione fra la tabelle many to many
        $deleted = $post->delete();

        if ($deleted){
            // check per cancellare eventuali immagini
            if (!empty($post->path_img)){
                Storage::disk('public')->delete($image);
            }
            return redirect()->route('posts.index')->with('post-deleted', $title);
        }else {
            return redirect()->route('homepage');
        }

    }

    /**
     *! FUNCTION VALIDATE RULE
     */

    private function ruleValidation(){
        return [
            'title' => 'required',
            'body' => 'required',
            'path_img' => 'mimes:jpeg,bmp,png,jpg'
        ];
    }
}
