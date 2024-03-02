<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;

class Formulario extends Component
{
    public $categories, $tags;

    public PostCreateForm $postCreate;

    public PostEditForm $postEdit;
    
    public $posts;

    

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();

        $this->posts = Post::all();
    }

    public function save()
    {
        $this->postCreate->save();
        $this->posts = Post::all();

    }

    public function edit(Post $post)
    {
        $this->resetValidation();
        $this->postEdit->edit($post);
    }

    public function update()
    {
        $this->postEdit->update();
        $this->posts = Post::all();

    }

    public function destroy(Post $post)
    {
        $post->delete();
        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
