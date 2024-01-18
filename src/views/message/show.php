<div class="show">
	<h3>Message</h3>
	<div class="show__message">
		<div><?php echo $message->header ?></div>
		<div><?php echo $message->author ?></div>
		<div class="show__message__foreword"><?php echo $message->foreword ?></div>
		<div class="show__message__body"><?php echo $message->body ?></div>
	</div>

	<a href="<?php echo Router::url('messages.edit', $message->id) ?>">
		<button>Edit message</button>
	</a>

	<?php if (!empty($comments)) : ?>
		<h3>Comments</h3>
		<div class="show__comments">
			<?php foreach ($comments as $comment) : ?>
				<div class="show__comments__comment"><?php echo $comment->comment ?></div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<form class="comment__form" action="<?php echo Router::url('comments.store', $message->id); ?>" method="post">
		<textarea name="comment" placeholder="Comment" rows="6"></textarea>
		<input type="submit" value="Create comment">
	</form>
</div>

<style>
	.show,
	.comment__form {
		display: flex;
		flex-direction: column;
		align-items: center;
		row-gap: 10px;
		width: 600px;
		margin: auto;
	}

	.show__message {
		border: 1px solid black;
		width: 100%;
	}

	.show__message>div,
	.show__comments>div {
		padding: 10px;
	}

	.show__message>div:not(:last-child) {
		border-bottom: 1px solid black;
	}

	.show__comments {
		display: flex;
		flex-direction: column;
		row-gap: 10px;
		width: 100%;
	}

	.show__comments>div {
		border: 1px solid black;
	}

	.comment__form>textarea {
		width: 80%;
		box-sizing: border-box;
		padding: 10px;
	}

	h3 {
		margin-bottom: 0;
	}

	.show__message__foreword,
	.show__message__body,
	.show__comments__comment {
		white-space: pre-wrap;
	}
</style>