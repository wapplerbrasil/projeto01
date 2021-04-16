<?php
define('BASE_URL', __DIR__);

// default config
$CONFIG_DEBUG = FALSE;
$CONFIG_TEMP_FOLDER = sys_get_temp_dir();
$CONFIG_CORS_ORIGIN = FALSE;
$CONFIG_CORS_METHODS = 'GET,POST';
$CONFIG_CORS_ALLOWED_HEADERS = '*';
$CONFIG_CORS_CREDENTIALS = TRUE;

$configPath = BASE_URL . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, '../dmxConnect/config.php');
if (file_exists($configPath)) {
	include_once($configPath);
}

function CONFIG($prop) {
  global ${'CONFIG_' . $prop};

	$val = ${'CONFIG_' . $prop};

	/*
  if (@constant($prop) !== NULL) {
		$val = @constant($prop);
	}
  */
  
  return $val;
}

if (!CONFIG('DEBUG')) {
	$errorlevel = error_reporting();
	error_reporting($errorlevel & ~(E_WARNING | E_NOTICE | E_STRICT | E_DEPRECATED));
}

function fatal_handler() {
	$error = error_get_last();

	if ($error !== NULL && $error['type'] == 1) {
		//ob_clean();

		$phpSapiName = substr(php_sapi_name(), 0, 3);
        if ($phpSapiName == 'cgi' || $phpSapiName == 'fpm') {
            header('Status: 500 Internal Server Error');
        } else {
            $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';
            header($protocol . ' 500 Internal Server Error');
        }

		if (CONFIG('DEBUG')) {
			header('Content-Type: Application/json; charset=utf-8');
			exit(json_encode(array(
				'code'    => $error["type"],
				'file'    => $error["file"],
				'line'    => $error["line"],
				'message' => $error["message"]
			)));
		} else {
			exit('A server error occured, to see the error enable the DEBUG flag.');
		}
	}
}

register_shutdown_function('fatal_handler');

function exception_error_handler($errno, $errstr, $errfile, $errline) {
	if (error_reporting() == 0) {
		return;
	}

	throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler('exception_error_handler');

function exception_handler($exception) {
	if (error_reporting() == 0) {
		return;
	}

	$phpSapiName = substr(php_sapi_name(), 0, 3);
	if ($phpSapiName == 'cgi' || $phpSapiName == 'fpm') {
		header('Status: 500 Internal Server Error');
	} else {
		$protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';
		header($protocol . ' 500 Internal Server Error');
	}

	if (CONFIG('DEBUG')) {
		header('Content-Type: Application/json; charset=utf-8');
		exit(json_encode(array(
			'code'    => $exception->getCode(),
			'file'    => $exception->getFile(),
			'line'    => $exception->getLine(),
			'message' => $exception->getMessage(),
			'trace'   => $exception->getTraceAsString()
		)));
	} else {
		exit('A server error occured, to see the error enable the DEBUG flag.');
	}
}

set_exception_handler('exception_handler');
spl_autoload_register(function($class) {
	$path = BASE_URL . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'server_connect' . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . '.php';

	if (file_exists($path) === FALSE || is_readable($path) === FALSE) {
		$path = BASE_URL . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $class) . '.php';
	}

	if (file_exists($path) === FALSE || is_readable($path) === FALSE) {
		return FALSE;
	}

	require($path);
});

require(__DIR__ . '/portable-utf8.php');

function option_require($options, $option) {
	if (is_array($option)) {
		foreach ($option as $o) {
			option_require($options, $o);
		}
		return;
	}

	if (isset($options->$option)) {
		return;
	}

	throw new \Exception('Option "' . $option . '" is required!');
}

function option_default(&$options, $option, $value) {
	if (is_array($option)) {
		foreach ($option as $o => $v) {
			option_default($options, $o, $v);
		}
		return;
	}

	if (!isset($options->$option)) {
		$options->$option = $value;
	}
}

if (CONFIG('CORS_ORIGIN') !== FALSE) {
	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		$origin = CONFIG('CORS_ORIGIN') ?: '*';
		$methods = CONFIG('CORS_METHODS');
		$allowedHeaders = CONFIG('CORS_ALLOWED_HEADERS');

		if ($origin == '*' && isset($_SERVER['HTTP_ORIGIN'])) {
			$origin = $_SERVER['HTTP_ORIGIN'];
		}
		
		header("HTTP/1.1 204 NO CONTENT");
		header("Access-Control-Allow-Origin: $origin");
		header("Access-Control-Allow-Methods: $methods");
		if (CONFIG('CORS_CREDENTIALS') === TRUE) {
			header("Access-Control-Allow-Credentials: true");
		}
		header("Access-Control-Allow-Headers: $allowedHeaders");

		exit();
	} else {
		$origin = CONFIG('CORS_ORIGIN') ?: '*';

		if ($origin == '*' && isset($_SERVER['HTTP_ORIGIN'])) {
			$origin = $_SERVER['HTTP_ORIGIN'];
		}

		try {
			if (!empty($_SERVER['HTTPS'])) {
				if (version_compare(PHP_VERSION, '7.3.0', '<')) {
					session_set_cookie_params(0, '/; samesite=None', $_SERVER['HTTP_HOST'], TRUE, TRUE);
				} else {
					session_set_cookie_params([
						'samesite' => 'None',
						'httponly' => TRUE,
						'secure' => TRUE
					]);
				}
			}
		} catch (\Exception $e) {
			// ignore
		}
		
		header("Access-Control-Allow-Origin: $origin");
		if (CONFIG('CORS_CREDENTIALS') === TRUE) {
			header("Access-Control-Allow-Credentials: true");
		}
	}
}