<?php

namespace App\Http\Controllers;

use \App\Entities\Post;
use App\Entities\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Post $post)
    {
        // We create into the table a resource.
       /*Subscription::create([
            'post_id' => $post->id,
            'user_id' => auth()->id(),
        ]);*/

        // Or We can
        // Run a relation and attach the $post
        auth()->user()->subscriptions()->attach($post);

        // Redirect to the route of the post
        //return redirect()->route('posts.show',[$post->id, $post->slug]);

        // or too function getUrlAttribute of the model Post
        return redirect($post->url);

    }

}
