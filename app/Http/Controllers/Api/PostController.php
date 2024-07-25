<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\NewUserWelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostResource::collection(Post::orderBy('id', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload/posts'), $fileName);
        $file = 'upload/posts/' . $fileName;
        $validated = $request->safe()->except(['file']);
        $validated['file'] = $file;
        $posts = Post::create($validated);
        return new PostResource($posts);

        // return response()->json(['success' => 'Post has been created successfully.']);
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|max:255',
        //     'email' => 'required',
        //     'address' => 'required',
        //     'website' => 'required',
        // ]);
        // $posts = Post::create($validator->validated());
        // // dispatch(new NewUserWelcomeMail($posts));
        // return new PostResource($posts);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);
        $post->update($validator->validated());
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }

    public function exportFile(Request $request)
    {
        // Create an array of elements 
        $filePath = public_path("posts/posts.csv");

        // Open a file in write mode ('w') 
        $fp = fopen(public_path("posts/posts.csv"), 'w');
        chmod($filePath, 0777);

        // Loop through file pointer and a line 
        fputcsv($fp, array_values(['id', 'userid', 'title', 'message', 'seen', 'is_sent', 'created_at', 'updated_at']));
        DB::table('notifications_test')->orderBy('notifications_test.userid')->chunk(500, function ($records) use ($fp) {
            foreach ($records as $data) {
                fputcsv($fp, (array) $data);
            }
        });

        fclose($fp);

        // For CSV Download.
        $headers = ['Content-Type: application/csv'];
        // New Name for downloaded file. non playing team
        $newName = 'notifications-' . date('Y-m-d') . '.csv';

        // Create a Job Here In which we can Attach the exported file and Send an Email.
        die("--------");
    }
}
