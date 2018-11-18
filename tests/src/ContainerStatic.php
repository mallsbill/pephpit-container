<?php
namespace Pephpit\Container\tests\units;

use Pephpit\Container\ContainerStatic as TestedClass;
use	mageekguy\atoum;

class ContainerStatic extends atoum\test {

	public function testExists(){

		$resFalse = TestedClass::exists('test');

		$this->boolean($resFalse)->isFalse();

		$entry = new \stdClass();
		TestedClass::set('test', $entry);

		$resTrue = TestedClass::exists('test');

		$this->boolean($resTrue)->isTrue();
	}

	public function testGet() {

		$this->exception(
			function() {
				TestedClass::get('test');
			}
		)
			->isInstanceOf(\Pephpit\Container\NotFoundException::class)
			->hasMessage('Entry test not found');

		$entry = new \stdClass();

		TestedClass::set('test', $entry);
		$res = TestedClass::get('test');

		$this->object($res)->isInstanceOf('\\stdClass');

	}

	public function testRemove(){
		$entry = new \stdClass();

		TestedClass::set('test', $entry);
		$res = TestedClass::get('test');

		$this->object($res)->isInstanceOf('\\stdClass');

		TestedClass::remove('test');

		$this->exception(
			function() {
				TestedClass::get('test');
			}
		)
			->isInstanceOf(\Pephpit\Container\NotFoundException::class)
			->hasMessage('Entry test not found');
	}

}
