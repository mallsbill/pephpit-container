<?php
namespace Pephpit\Container;

interface ContainerInterface extends \ArrayAccess, \Psr\Container\ContainerInterface {

	public function exists(string $id);

	public function set(string $id, $entry);

	public function remove(string $id);

}
