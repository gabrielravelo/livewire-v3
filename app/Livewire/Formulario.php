<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Rule;

class Formulario extends Component
{
    public $categories, $tags;

    // #[Rule('required', message: 'El campo titulo es requerido')]
    // public $title; 

    // #[Rule('required')]
    // public $content;

    // #[Rule('required|exists:categories,id', as: 'categoria')]
    // public $category_id = '';

    // #[Rule('required|array')]
    // public $selectedTags = [];

    // #[Rule([
    //     'postCreate.category_id' => 'required|exists:categories,id',
    //     'postCreate.content' => 'required',
    //     'postCreate.title' => 'required',
    //     'postCreate.tags' => 'required|array'
    // ], [], [
    //     'postCreate.category_id' => 'categoria'
    // ])]
    public $postCreate = [
        'category_id' => '',
        'title' => '',
        'content' => '',
        'tags' => []
    ];

    public $posts;

    public $postEditId = '';

    public $postEdit = [
        'category_id' => '',
        'title' => '',
        'content' => '',
        'tags' => []
    ];

    public $open = false;

    public function rules()
    {
        return [
            'postCreate.category_id' => 'required|exists:categories,id',
            'postCreate.content' => 'required',
            'postCreate.title' => 'required',
            'postCreate.tags' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'postCreate.title.required' => 'El campo nombre es obligatorio'
        ];
    }

    public function validationAttributes()
    {
        return [
            'postCreate.category_id' => 'categoria'
        ];
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();

        $this->posts = Post::all();
    }

    public function save()
    {
        $this->validate();
        // $this->validate([
        //     'title' => 'required',
        //     'content' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        //     'selectedTags' => 'required|array'
        // ], [
        //     'title.required' => 'El campo titulo es requerido',
        // ], [
        //     'category_id' => 'categoria',
        // ]);
        // $post = Post::create([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        // ]);

        $post = Post::create([
            'category_id' => $this->postCreate['category_id'],
            'title' => $this->postCreate['title'],
            'content' => $this->postCreate['content']
            // $this->only('category_id', 'title', 'content')
        ]);

        $post->tags()->attach($this->postCreate['tags']);

        $this->reset(['postCreate']);

        $this->posts = Post::all();

    }

    public function edit(Post $post)
    {
        $this->resetValidation();
        $this->open = true;
        $this->postEditId = $post->id;
        // $post = Post::find($postId);

        $this->postEdit['category_id'] = $post->category_id;
        $this->postEdit['title'] = $post->title;
        $this->postEdit['content'] = $post->content;
        $this->postEdit['tags'] = $post->tags->pluck('id')->toArray();
    }

    public function update()
    {
        $this->validate([
            'postEdit.category_id' => 'required|exists:categories,id',
            'postEdit.content' => 'required',
            'postEdit.title' => 'required',
            'postEdit.tags' => 'required|array'
        ]);

        $post = Post::find($this->postEditId);

        $post->update([
            'category_id' => $this->postEdit['category_id'],
            'title' => $this->postEdit['title'],
            'content' => $this->postEdit['content'],
        ]);

        $post->tags()->sync($this->postEdit['tags']);

        $this->reset(['postEditId', 'postEdit', 'open']);

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
