<?php

class DB
{
	protected static $db;

	private function __construct()
	{
	}

	private function __clone()
	{
	}

	public static function get()
	{
		if (is_null(self::$db)) {
			self::$db = new mysqli(
				$_ENV['MYSQL_HOST'],
				$_ENV['MYSQL_USER'],
				$_ENV['MYSQL_PASSWORD'],
				$_ENV['MYSQL_DATABASE']
			);
		}
		return self::$db;
	}

	public static function close()
	{
		if (self::$db) {
			self::$db->close();
		}
	}
}
