<?php

class Message
{

	function __construct(
		public int $id,
		public string $header,
		public string $author,
		public string $foreword,
		public string $body,
	) {
		$this->header = htmlspecialchars($this->header);
		$this->author = htmlspecialchars($this->author);
		$this->foreword = htmlspecialchars($this->foreword);
		$this->body = htmlspecialchars($this->body);
	}
}
