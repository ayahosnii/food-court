<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class BlogComponent extends Component
{
    public function render()
    {
        $posts = Post::get();
        return view('livewire.blog-component', ['posts' => $posts])->layout('layouts.font-layout');
    }
}
