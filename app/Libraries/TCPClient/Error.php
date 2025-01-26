<?php

namespace App\Libraries\TCPClient;

use Exception;

class Error
{
	public string $code;
	public string $message;

	public function __construct(string $code, string $message)
	{
		$this->code = $code;
		$this->message = $message;
	}
}
