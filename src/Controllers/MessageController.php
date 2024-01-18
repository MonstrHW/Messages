<?php

class MessageController
{
	private MessageService $messageService;

	function __construct()
	{
		$this->messageService = new MessageService();
	}

	public function index()
	{
		$page = 1;

		if (isset($_GET['p'])) {
			if (!is_numeric($_GET['p']) || $_GET['p'] < 1) {
				http_response_code(404);
				return;
			}

			$page = $_GET['p'];
		}

		$messagePerPage = 3;
		$messagesCount = $this->messageService->getMessagesCount();
		$pageCount = ceil($messagesCount / $messagePerPage);

		if ($messagesCount !== 0 && $page > $pageCount) {
			http_response_code(404);
			return;
		}

		$endMessage = $page * $messagePerPage;
		$startMessage = $endMessage - $messagePerPage;
		$startMessage++;
		$messages = $this->messageService->getMessages($startMessage, $endMessage);

		view('message/index', compact('messages', 'pageCount', 'page'));
	}

	public function show(int $id)
	{
		$message = $this->messageService->getMessage($id);

		if ($message === null) {
			http_response_code(404);
			return;
		}

		$comments = (new CommentService())->getComments($id);

		view('message/show', compact('message', 'comments'));
	}

	public function create()
	{
		view('message/create');
	}

	public function store()
	{
		$messageId = $this->messageService->createMessage($_POST);

		redirect(Router::url('messages.show', $messageId));
	}

	public function edit(int $id)
	{
		$message = $this->messageService->getMessage($id);

		if ($message === null) {
			http_response_code(404);
			return;
		}

		view('message/edit', compact('message'));
	}

	public function update(int $id)
	{
		$this->messageService->updateMessage($id, $_POST);

		redirect(Router::url('messages.show', $id));
	}
}
