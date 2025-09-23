<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Discussion;

class ForumController extends Controller
{

    public function index()
    {
        $categories = Category::all();  // Récupérer toutes les catégories
        $discussions = Discussion::with('user')->get(); // Récupérer toutes les discussions avec leurs utilisateurs
    
        return view('forum.index', compact('categories', 'discussions'));
    }
    

    

    public function showCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $discussions = $category->discussions()->with('user')->get();

        return view('forum.category', compact('category', 'discussions'));
    }

    public function showDiscussion($discussionId)
    {
        $discussion = Discussion::with('posts.user')->findOrFail($discussionId);
        
        return view('forum.discussion', compact('discussion'));
    }

    public function storeDiscussion(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Création de la discussion
    $discussion = Discussion::create([
        'title' => $request->title,
        'content' => $request->content,
        'user_id' => auth()->id(),
        'category_id' => $request->category_id,
    ]);

    // Redirection vers la discussion créée avec l'ID
    return redirect()->route('forum.discussion', ['discussionId' => $discussion->id])
                     ->with('success', 'Fil de discussion créé avec succès');
}


    public function storePost(Request $request, $discussionId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'discussion_id' => $discussionId,
        ]);

        return redirect()->route('forum.discussion', $discussionId);
    }
}
