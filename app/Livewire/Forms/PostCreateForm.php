<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostCreateForm extends Form
{
    #[Validate('required|min:3')]
    public $title;

    #[Validate('required')]
    public $content;

    #[Validate('required|exists:categories,id')]
    public $category_id = '';

    #[Validate('required|array')]
    public $tags = [];

    public function save()
    {
        $this->validate();

        $post = Post::create(
            $this->all()
        );

        $post->tags()->attach($this->tags);

        $this->reset();
    }
}
