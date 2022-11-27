<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostController extends Controller
{
    public const PAGE_SIZE = 20;
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $posts = Post::query()->paginate(self::PAGE_SIZE);
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return PostResource
     */
    public function store(StorePostRequest $request): PostResource
    {
        $post = Post::query()->create($request->validated());
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return PostResource
     */
    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(UpdatePostRequest $request, Post $post): PostResource
    {
        $updated = $post->update($request->validated());

        if (!$updated) {
            return response()->json([
                'errors' => 'Failed to update model.'
            ], Response::HTTP_BAD_REQUEST);
        }

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return PostResource
     */
    public function destroy(Post $post): PostResource
    {
        $deleted = $post->delete();

        if (!$deleted) {
            return response()->json([
                'errors' => 'Could not delete resource'
            ], Response::HTTP_BAD_REQUEST);
        }
        return new PostResource($post);
    }
}
