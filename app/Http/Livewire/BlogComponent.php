<?php

namespace App\Http\Livewire;

use App\Models\CategoryBlog;
use App\Models\Post;
use Livewire\Component;

class BlogComponent extends Component
{
    public $search = '';
    public $selectedCategory = null;


    public function filterByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function render()
    {
        $query = Post::query();

        // Apply search filter
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        // Apply category filter
        if ($this->selectedCategory) {
            $query->whereHas('category', function ($query) {
                $query->where('id', $this->selectedCategory);
            });
        }

        $posts = $query->get();
        $categoryBlogs = CategoryBlog::get();

        return view('livewire.blog-component', ['posts' => $posts, 'categoryBlogs' => $categoryBlogs])
            ->layout('layouts.font-layout');
       }
}
