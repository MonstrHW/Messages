<?php

function view(string $view, array $data = [])
{
	extract($data);

	require './views/start_layout.php';
	require './views/' . $view . '.php';
	require './views/end_layout.php';
}

function redirect(string $to = '/')
{
	header("Location: " . $to);
}

function dd($value)
{
	echo "<pre>";
	print_r($value);
	echo "</pre>";
}
