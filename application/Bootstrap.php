<?php
/**
 * @name Bootstrap
 * @author qloog
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf\Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */

 use Illuminate\Events\Dispatcher as LDispatcher;
 use Illuminate\Container\Container as LContainer;
 use Illuminate\Database\Capsule\Manager as Capsule;

class Bootstrap extends Yaf\Bootstrap_Abstract {

    public function _initConfig() {
		//把配置保存起来
		$arrConfig = Yaf\Application::app()->getConfig();
		Yaf\Registry::set('config', $arrConfig);
	}

	public function _initPlugin(Yaf\Dispatcher $dispatcher) {
		//注册一个插件
		$objSamplePlugin = new SamplePlugin();
		$dispatcher->registerPlugin($objSamplePlugin);
	}

	public function _initRoute(Yaf\Dispatcher $dispatcher) {
		//在这里注册自己的路由协议,默认使用简单路由
        /** 通过程序添加 */
        // $router = Yaf\Dispatcher::getInstance()->getRouter();
        // $simpleRoute = new Yaf\Route\Simple('m', 'c', 'a');
        // $router->addRoute('simple_route', $simpleRoute);

        /** 通过配置文件添加 */
        $router = Yaf\Dispatcher::getInstance()->getRouter();
        //添加配置中的路由
        $router->addConfig(Yaf\Registry::get("config")->routes);


        //增加一些路由规则
        //默认是 Yaf_Route_Static
        // $config = require(APP_PATH .'/conf/routes.php');
        // $router = $dispatcher->getRouter();
        // $router->addConfig($config);

	}

	public function _initView(Yaf\Dispatcher $dispatcher) {
		//在这里注册自己的view控制器，例如smarty,firekylin
	}


    public function _initDefaultDbAdapter(Yaf\Dispatcher $dispatcher){
        $capsule = new Capsule();
        $capsule->addConnection(Yaf\Registry::get("config")->database->toArray());
        $capsule->setEventDispatcher(new LDispatcher(new LContainer));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
