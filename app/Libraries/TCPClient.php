<?php

namespace App\Libraries;

use App\Libraries\TCPClient\{Error, Exception};
use Socket;

use Illuminate\Support\Facades\Log;

class TCPClient
{
	private Socket $socket;

	private int $maxLength = 1024;

	private string $receivedData = '';

	private function __construct() {}

	public static function build()
	{
		return new self();
	}

	public function createSocket(): self
	{
		$result = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

		if ($result === false) {
			$error = new Error('invalid_socket', $this->normailizeErrorMessage());
			Log::error("Creating socket failed, as the reason is " . json_encode($error) . ".");

			throw new Exception($error);
		} else {
			$this->socket = $result;

			return $this;
		}
	}

	public function connectSocket(): self
	{
		$result = socket_connect($this->socket, env('AIGC_SERVER_HOST'), env('AIGC_SERVER_PORT'));

		if ($result === false) {
			$error = new Error('invalid_socket', $this->normailizeErrorMessage($this->socket));
			Log::error("Connecting socket server failed, as the reason is " . json_encode($error) . ".");

			throw new Exception($error);
		} else {
			return $this;
		}
	}

	public function writeLine(string $requestData): void
	{
		$result = socket_write($this->socket, $requestData, strlen($requestData));

		if ($result === false) {
			$error = new Error('server_error', $this->normailizeErrorMessage($this->socket));
			Log::error("Writing data into socket failed, as the reason is " . json_encode($error) . ".");

			throw $error;
		}
	}

	public function readLine(): string
	{
		while (true) {
			$buffer = socket_read($this->socket, $this->maxLength);

			if ($buffer === false) {
				$error = new Error('server_error', $this->normailizeErrorMessage($this->socket));
				Log::error("Reading data from socket failed, as the reason is " . json_encode($error) . ".");

				throw $error;
			} elseif (strlen($buffer) < 1024) {
				// TODO: 这里应该有个问题，循环读取 server 返回的数据，如果返回的数据的总长度被 1024 整除，就会陷入无限循环。
				$this->receivedData .= $buffer;
				break;
			} else {
				$this->receivedData .= $buffer;
			}
		}

		return $this->receivedData;
	}

	private function normailizeErrorMessage(?Socket $socket = null): string
	{
		return socket_strerror(socket_last_error($socket));
	}
}
