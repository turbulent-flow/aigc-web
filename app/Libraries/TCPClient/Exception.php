<?php

namespace App\Libraries\TCPClient;

use Exception as BasicException;
use App\Libraries\TCPClient\Error;

class Exception extends BasicException
{
	public Error $containedError;

	public function __construct(Error $containedError)
	{
		$this->containedError = $containedError;
	}
}
