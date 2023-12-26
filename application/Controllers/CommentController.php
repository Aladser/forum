<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

/** комментарии */
class CommentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->articles = new Article();
        $this->users = new User();
        $this->comments = new Comment();
    }

    public function store()
    {
        $author = $_POST['author'];
        $authorId = $this->users->getId($author);
        $articleId = $_POST['article'];
        $content = $_POST['message'];

        $id = $this->comments->add($authorId, $articleId, $content);
        echo json_encode([
            'result' => $id,
            'comment' => ['author' => $author, 'content' => $content, 'id' => $id],
        ]);
    }

    public function remove()
    {
        $id = $_POST['id'];
        $isRemoved = $this->comments->remove($id);
        echo json_encode(['result' => (int) $isRemoved]);
    }
}
