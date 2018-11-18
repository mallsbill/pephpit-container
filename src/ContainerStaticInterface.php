<?php
namespace Pephpit\Container;

interface ContainerStaticInterface {

	public static function exists(string $id);

	public static function set(string $id, $entry);

	public static function get(string $id);

	public static function remove(string $id);

}
