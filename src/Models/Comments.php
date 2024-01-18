<?php

class Comment
{
	function __construct(
		public int $id,
		public string $comment,
	) {
		$this->comment = htmlspecialchars($this->comment);
	}
}
