<?php

namespace Pephpit\Container;

class Container implements ContainerInterface {

	protected $entries;

	/**
	 * Check if the entry exist
	 * @param string $id entry id
	 * @return boolean
	 */
	public function exists(string $id): bool {
		return isset($this->entries[$id]);
	}

	/**
	 * Define a new entry
	 * @param string $id entry id
	 * @param object $entry entry instance
	 * @throws Exception
	 */
	public function set(string $id, $entry): Container {	
		if(isset($this->entries[$id])){
			throw new Exception('Entry '.$id.' already exist');
		}

		if(!is_object($entry)){
			throw new Exception('Entry '.$id.' should be an object');
		}

		$this->entries[$id] = $entry;
		return $this;
	}

	/**
	 * Remove a entry
	 * @param string $id entry id
	 * @return \Pephpit\Container\Container
	 * @throws NotFoundException
	 */
	public function remove(string $id): Container {
		
		if (!isset($this->entries[$id])) {
			throw new NotFoundException($id);
		}
		
		unset($this->entries[$id]);
		return $this;
	}

	/**
	 * Get a entry
	 * @param string $id entry id
	 * @return object
	 * @throws Exception
	 */
	public function get($id) {
	
		if (!isset($this->entries[$id])) {
			throw new NotFoundException($id);
		}

		return $this->entries[$id];
	}
	
	public function has($id): bool {
		return $this->exists($id);
	}

	public function __set($id, $entry) {
		return $this->set($id, $entry);
	}

	public function __get($id) {
		return $this->get($id);
	}

	public function offsetExists($id) {
		return $this->exists($id);
	}

	public function offsetSet($id, $entry) {
		return $this->set($id, $entry);
	}

	public function offsetUnset($id) {
		return $this->remove($id);
	}

	public function offsetGet($id) {
		return $this->get($id);
	}

}
