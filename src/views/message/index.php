<div class="index">
	<?php foreach ($messages as $message) : ?>
		<div class="index__message">
			<div class="index__message__header">
				<a href="<?php echo Router::url('messages.show', $message->id) ?>">
					<?php echo $message->header ?>
				</a>
			</div>
			<div class="index__message__foreword"><?php echo $message->foreword ?></div>
		</div>
	<?php endforeach; ?>

	<a href="<?php echo Router::url('messages.create') ?>"><button>Create message</button></a>

	<div class="index__pages">
		<?php for ($i = 1; $i <= $pageCount; $i++) : ?>
			<a class="<?php echo $i == $page ? 'index__pages__current' : '' ?>" href="<?php echo Router::url('messages.index') . '/?p=' . $i ?>">
				<?php echo $i ?>
			</a>
		<?php endfor; ?>
	</div>
</div>

<style>
	.index {
		display: flex;
		flex-direction: column;
		align-items: center;
		row-gap: 10px;
		width: 600px;
		margin: auto;
	}

	.index__message {
		border: 1px solid black;
		width: 100%;
	}

	.index__message__header {
		padding: 10px;
		border-bottom: 1px solid black;
	}

	.index__message__foreword {
		padding: 10px;
	}

	.index__pages {
		display: flex;
		flex-wrap: wrap;
	}

	.index__pages>a {
		text-decoration: none;
		padding-left: 6px;
		padding-right: 6px;
	}

	.index__pages__current {
		border: 1px solid black;
	}

	.index__message__foreword {
		white-space: pre-wrap;
	}
</style>