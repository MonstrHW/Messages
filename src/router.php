<?php

class Router
{
	private static array $regexedRoutes = [];
	private static array $routesByName = [];

	private static function addRoute(string $reqMethod, string $route, $action, string $name)
	{
		$regex = '~^' . str_replace('*', '(\d+)', $route) . '$~';
		self::$regexedRoutes[$reqMethod][$regex] = $action;

		if ($name) {
			self::$routesByName[$name] = $route;
		}
	}

	public static function get(string $route, array|callable $action, string $name = '')
	{
		self::addRoute('GET', $route, $action, $name);
	}

	public static function post(string $route, array|callable $action, string $name = '')
	{
		self::addRoute('POST', $route, $action, $name);
	}

	public static function handle(string $reqMethod, string $uri)
	{
		$uri = explode('?', $uri)[0];
		$uri = '/' . trim($uri, '/');

		if (isset(self::$regexedRoutes[$reqMethod])) {
			foreach (self::$regexedRoutes[$reqMethod] as $regex => $action) {
				if (preg_match($regex, $uri, $params)) {
					array_shift($params);

					if (is_callable($action)) {
						return call_user_func_array($action, $params);
					}

					[$class, $method] = $action;

					return (new $class())->$method(...$params);
				}
			}
		}

		http_response_code(404);
	}

	public static function url(string $name, ...$params): string
	{
		if (!isset(self::$routesByName[$name])) {
			throw new Exception('Route ' . $name . ' does not exist.');
		}

		$result = self::$routesByName[$name];

		foreach ($params as $param) {
			$result = preg_replace('/\*/', $param, $result, 1);
		}

		return $result;
	}
}
