<?php
namespace Pephpit\Container\tests\units;

use Pephpit\Container\Container as TestedClass;
use	mageekguy\atoum;

class Container extends atoum\test {

	public function testExists() {
		$testedClass = new TestedClass();
		$resFalse = $testedClass->exists('test');

		$this->boolean($resFalse)->isFalse();

		$entry = new \stdClass();
		$testedClass->set('test', $entry);

		$resTrue = $testedClass->exists('test');

		$this->boolean($resTrue)->isTrue();
	}

	public function testSetObjectException() {
		$testedClass = new TestedClass();
		$this->exception(
			function() use($testedClass) {
				$testedClass->set('test', 'test');
			}
		)
			->isInstanceOf(\Pephpit\Container\Exception::class)
			->hasMessage('Entry test should be an object');
	}

	public function testSetAlreadyExistException() {
		$entry = new \stdClass();

		$testedClass = new TestedClass();
		$testedClass->set('test', $entry);
		
		$this->exception(
			function() use($testedClass, $entry) {
				$testedClass->set('test', $entry);
			}
		)
			->isInstanceOf(\Pephpit\Container\Exception::class)
			->hasMessage('Entry test already exist');
	}

	public function testGetNotFoundException() {

		$testedClass = new TestedClass();
		$this->exception(
			function() use($testedClass) {
				$testedClass->get('test');
			}
		)
			->isInstanceOf(\Pephpit\Container\NotFoundException::class)
			->hasMessage('Entry test not found');
	}

	public function testGet() {
		$entry = new \stdClass();

		$testedClass = new TestedClass();
		$testedClass->set('test', $entry);
		$res = $testedClass->get('test');

		$this->object($res)->isInstanceOf(\stdClass::class);

	}

	public function testRemove() {
		$entry = new \stdClass();

		$testedClass = new TestedClass();
		$testedClass->set('test', $entry);
		$res = $testedClass->get('test');

		$this->object($res)->isInstanceOf(\stdClass::class);

		$testedClass->remove('test');

		$this->exception(
			function() use($testedClass) {
				$testedClass->get('test');
			}
		)
			->isInstanceOf(\Pephpit\Container\NotFoundException::class)
			->hasMessage('Entry test not found');

		$this->exception(
			function() use($testedClass) {
				$testedClass->remove('test');
			}
		)
			->isInstanceOf(\Pephpit\Container\NotFoundException::class)
			->hasMessage('Entry test not found');

	}

	public function test__get(){
		$entry = new \stdClass();

		$testedClass = new TestedClass();
		$testedClass->test = $entry;
		$res = $testedClass->test;

		$this->object($res)->isInstanceOf(\stdClass::class);
	}

	public function testArrayAccess() {
		$entry = new \stdClass();

		$testedClass = new TestedClass();
		$testedClass['test'] = $entry;
		
		$resTrue = isset($testedClass['test']);
		$this->boolean($resTrue)->isTrue();
		
		$resEntry = $testedClass['test'];
		$this->object($resEntry)->isInstanceOf(\stdClass::class);

		unset($testedClass['test']);
		
		$resFalse = isset($testedClass['test']);
		$this->boolean($resFalse)->isFalse();

		$this->exception(
			function() use($testedClass) {
				$res = $testedClass['test'];
			}
		)
			->isInstanceOf(\Pephpit\Container\NotFoundException::class)
			->hasMessage('Entry test not found');

	}

}
