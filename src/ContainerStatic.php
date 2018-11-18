<?php
namespace Pephpit\Container;

class ContainerStatic implements ContainerStaticInterface {

	protected static $container;

	/**
	 * Get the Service Locator
	 * @return \Pephpit\Container\Container
	 */
	protected static function getContainer(){

		if( !isset(self::$container) ){
			self::$container = new Container();
		}

		return self::$container;

	}

	/**
	 * Check if the entry exist
	 * @param string $id entry id
	 * @return boolean
	 */
	public static function exists(string $id): bool {
		return self::getContainer()->exists($id);
	}

	/**
	 * Define a new entry
	 * @param string $id entry id
	 * @param object $entry entry instance
	 * @return \Pephpit\Container\Container
	 */
	public static function set(string $id, $entry) {
		self::getContainer()->set($id, $entry);
	}

	/**
	 * Remove a entry
	 * @param string $id entry id
	 * @return void
	 */
	public static function remove(string $id) {
		self::getContainer()->remove($id);
	}

	/**
	 * Get a entry
	 * @param string $id entry id
	 * @return object
	 */
	public static function get(string $id) {
		return self::getContainer()->get($id);
	}

}
