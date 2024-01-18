<div class="create">
	<h2>Create message</h2>
	<form class="create__form" action="<?php echo Router::url('messages.store'); ?>" method="post">
		<input type="text" name="header" placeholder="Header">
		<input type="text" name="author" placeholder="Author">
		<textarea name="foreword" placeholder="Foreword" rows="6"></textarea>
		<textarea name="body" placeholder="Body" rows="10"></textarea>

		<input type="submit" value="Create">
	</form>
</div>


<style>
	.create {
		display: flex;
		flex-direction: column;
		align-items: center;
	}

	.create__form {
		display: flex;
		flex-direction: column;
		align-items: center;
		row-gap: 10px;
		width: 450px;
	}

	.create__form>input,
	.create__form>textarea {
		width: 100%;
		padding: 10px;
		box-sizing: border-box;
	}
</style>