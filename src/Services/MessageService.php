<?php

class MessageService
{
	function __construct()
	{
	}

	public function getMessagesCount(): int
	{
		$result = DB::get()->query("SELECT COUNT(*) AS count FROM messages");
		return $result->fetch_assoc()['count'];
	}

	public function getMessages(int $start, int $end): array
	{
		$result = DB::get()->execute_query("SELECT * FROM messages WHERE id >= ? AND id <= ?", [$start, $end]);

		$messages = [];

		while ($row = $result->fetch_assoc()) {
			$messages[] = new Message(
				$row['id'],
				$row['header'],
				$row['author'],
				$row['foreword'],
				$row['body'],
			);
		}

		return $messages;
	}

	public function getMessage(int $id): Message|null
	{
		$result = DB::get()->execute_query("SELECT * FROM messages WHERE id = ?", [$id]);

		if ($result->num_rows === 0) {
			return null;
		}

		$row = $result->fetch_assoc();

		return new Message(
			$row['id'],
			$row['header'],
			$row['author'],
			$row['foreword'],
			$row['body'],
		);
	}

	public function createMessage(array $data): int
	{
		DB::get()->execute_query(
			"INSERT INTO messages (header, author, foreword, body) VALUES (?, ?, ?, ?)",
			[
				$data['header'],
				$data['author'],
				$data['foreword'],
				$data['body']
			]
		);

		return DB::get()->insert_id;
	}

	public function updateMessage(int $id, array $data)
	{
		$result = DB::get()->execute_query(
			"UPDATE messages SET header = ?, author = ?, foreword = ?, body = ? WHERE id = ?",
			[
				$data['header'],
				$data['author'],
				$data['foreword'],
				$data['body'],
				$id
			]
		);
	}
}
