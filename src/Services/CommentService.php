<?php

class CommentService
{
	function __construct()
	{
	}

	public function getComments(int $messageId): array
	{
		$result = DB::get()->execute_query("SELECT * FROM comments WHERE message_id = ?", [$messageId]);

		$messages = [];

		while ($row = $result->fetch_assoc()) {
			$messages[] = new Comment(
				$row['id'],
				$row['comment'],
			);
		}

		return $messages;
	}

	public function createComment(int $messageId, string $comment)
	{
		DB::get()->execute_query(
			"INSERT INTO comments (comment, message_id) VALUES (?, ?)",
			[$comment, $messageId]
		);
	}
}
