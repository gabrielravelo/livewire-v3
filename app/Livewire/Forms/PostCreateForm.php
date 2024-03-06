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

    public $imageKey;

    #[Validate('image|max:1024|nullable')]
    public $image;

    public function save()
    {
        $this->validate();

        $post = Post::create(
            $this->all()
        );

        
        $post->tags()->attach($this->tags);
        
        if($this->image) {
            $post->image_path = $this->image->store('posts');
            $post->save();
        }

        $this->reset();
        $this->imageKey = rand();
    }
}
