<?php
namespace Pephpit\Container;

interface ContainerAwareInterface {

	public function setContainer(ContainerInterface $container);

	public function getContainer(): ContainerInterface;

}
