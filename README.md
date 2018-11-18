Pephpit \ Container
============


Static example
--------------

Add a service

	$memcached = new Memcached();
	$memcached->addServer('127.0.0.1', 1211);

	Pephpit\Container\ContainerStatic::set('cache', $memcached);

 Get a service

	class MyClass {

		public function myAction(){
			$cache = Pephpit\Container\ContainerStatic::get('cache');
			$cache->fetch('mykey');
			...
		}

	}


Non Static example
------------------

Add a entry

    // create new Memcached instance
	$memcached = new Memcached();
	$memcached->addServer('127.0.0.1', 1211);

	// Add memcache to the container
	$container = new Pephpit\Container\Container();
	$container->set('cache', $memcached);

	// Add container to an class
	$myClass = new MyClass();
	$myClass->setContainer($container);
	$myClass->myAction();

Get a service

    use Pephpit\Container\ContainerAwareInterface;
    use Pephpit\Container\ContainerInterface;

	class MyClass implements ContainerAwareInterface {

		private $container;

		public function setContainer(ContainerInterface $container){
			$this->container = $container;
		}

		public function getContainer(){
			return $this->container;
		}

		public function myAction(){
			$cache = $this->getContainer()->get('cache');
            $cache->fetch('mykey');
            ...
		}

	}



