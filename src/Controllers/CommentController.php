<?php

class CommentController
{
	public function store(int $messageId)
	{
		(new CommentService())->createComment($messageId, $_POST['comment']);

		redirect(Router::url('messages.show', $messageId));
	}
}
