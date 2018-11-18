<?php
namespace Pephpit\Container;

class NotFoundException extends \Exception implements \Psr\Container\NotFoundExceptionInterface {
	
	public function __construct(string $id = "", int $code = 0, \Throwable $previous = null) {
		parent::__construct('Entry '.$id.' not found', $code, $previous);
	}

}
