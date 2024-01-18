<div class="edit">
	<h2>Edit message</h2>
	<form class="edit__form" action="<?php echo Router::url('messages.update', $message->id); ?>" method="post">
		<input type="text" name="header" placeholder="Header" value="<?php echo $message->header; ?>">
		<input type="text" name="author" placeholder="Author" value="<?php echo $message->author; ?>">
		<textarea name="foreword" placeholder="Foreword" rows="6"><?php echo $message->foreword; ?></textarea>
		<textarea name="body" placeholder="Body" rows="10"><?php echo $message->body; ?></textarea>

		<input type="submit" value="edit">
	</form>
</div>


<style>
	.edit {
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	.edit__form {
		display: flex;
		flex-direction: column;
		align-items: center;
		row-gap: 10px;
		width: 450px;
	}

	.edit__form>input,
	.edit__form>textarea {
		width: 100%;
		padding: 10px;
		box-sizing: border-box;
	}
</style>