<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentSection extends Component
{
    public $post;
    public $body;
    public $editingId = null;
    public $editBody = '';

    protected $rules = [
        'body' => 'required|min:2|max:500'
    ];

    protected $messages = [
    'body.required' => 'Komentar tidak boleh kosong.',
    'body.min' => 'Komentar terlalu pendek, minimal :min karakter.',
    'body.max' => 'Komentar terlalu panjang, maksimal :max karakter.',
];


    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function addComment()
    {
        $this->validate();

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => Auth::id(),
            'body' => $this->body
        ]);

        $this->body = '';
    }


    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        $this->editingId = $id;
        $this->editBody = $comment->body;
    }

    public function update()
    {
        $comment = Comment::findOrFail($this->editingId);
        $comment->update(['body' => $this->editBody]);

        $this->editingId = null;
        $this->editBody = '';
    }
    
    public function delete($id)
    {
        Comment::findOrFail($id)->delete();
    }

    public function like($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $userId = Auth::id();

        $existing = CommentLike::where('user_id', $userId)
            ->where('comment_id', $commentId)
            ->first();

        if ($existing) {
            $existing->delete();
        } else {
            CommentLike::create([
                'user_id' => $userId,
                'comment_id' => $commentId
            ]);
        }
    }

    public function render()
    {

        return view('livewire.comment-section', ['comments' => Comment::with('likes', 'user')->where('post_id', $this->post->id)->latest()->get()]);
    }
}
