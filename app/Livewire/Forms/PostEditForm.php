<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostEditForm extends Form
{
    public $postId = '';
    public $open = false;

    #[Validate('required')]
    public $title;

    #[Validate('required')]
    public $content;

    #[Validate('required|exists:categories,id')]
    public $category_id = '';

    #[Validate('required|array')]
    public $tags = [];

    public function edit(Post $post)
    {
        $this->open = true;
        $this->postId = $post->id;

        $this->category_id = $post->category_id;
        $this->title = $post->title;
        $this->content = $post->content;

        $this->tags = $post->tags->pluck('id')->toArray();

    }

    public function update()
    {
        $this->validate();
        
        $post = Post::find($this->postId);

        $post->update(
            $this->all()
        );

        $post->tags()->sync($this->tags);

        $this->reset();
    }
}
