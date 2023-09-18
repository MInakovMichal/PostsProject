<?php

namespace Component\Post\Infrastructure\Http\Controllers;

use App\Http\Controllers\Controller;
use Common\Http\BaseRequest;
use Component\Post\Infrastructure\Http\Requests\AddPostRequest;
use Component\Post\Infrastructure\Http\Requests\DeletePostRequest;
use Component\Post\Sdk\PostFacade;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function __construct(readonly PostFacade $postFacade)
    {
    }

    public function showAddPostForm(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('post.create');
    }

    public function addPost(AddPostRequest $request): RedirectResponse
    {
        $this->postFacade->addPost($request);

        return redirect()->route('dashboard');
    }

    public function getAllPosts(BaseRequest $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $posts = $this->postFacade->getAllPosts();

        return view('post.posts')->with('posts', $posts);
    }

    public function deletePost(DeletePostRequest $request): JsonResponse
    {
        $this->postFacade->deletePost($request->getId());

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
