<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Formulario extends Component
{
    use WithFileUploads;
    
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
        $this->dispatch('new-comment', 'Articulo Nuevo');
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
        $this->dispatch('new-comment', 'Articulo Actualizado');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        $this->posts = Post::all();
        $this->dispatch('new-comment', 'Articulo Eliminado');
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
