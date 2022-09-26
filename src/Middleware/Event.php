<?php
/**
 * author : Mahmut Özdemir
 * web    : www.mahmutozdemir.com.tr
 * email  : bilgi@mahmutozdemir.com.tr
 * ----------------------------------------
 * Date   : 26.09.2022 14:31
 * File   : Event.php
 */

namespace Phalcon\Mahmut\Middleware;

use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

class Event extends Plugin
{
    /**
     * annotation name
     *
     * @var string
     */
    protected $annotationName;

    /**
     * Event constructor.
     *
     * @param string $annotationName
     */
    public function __construct(string $annotationName = 'Middleware')
    {
        $this->annotationName = $annotationName;
    }

    /**
     * before execute route
     *
     * @param \Phalcon\Events\Event $event
     * @param Dispatcher $dispatcher
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function beforeExecuteRoute(\Phalcon\Events\Event $event, Dispatcher $dispatcher, $data) : bool
    {
        $methodAnnotations = $this->annotations->getMethod($dispatcher->getHandlerClass(), $dispatcher->getActiveMethod());
        if(!$methodAnnotations->has($this->annotationName)){
            return true;
        }

        foreach($methodAnnotations->getAll($this->annotationName) as $annotation){

            $arguments = $annotation->getArguments();
            $class = array_shift($arguments);

            if(!class_exists($class)){
                throw new Exception('Middleware class not exist');
            }

            $controller = new $class();
            if(!$controller instanceof InterfaceMiddleware){
                throw new Exception('Middleware interface is not implemented');
            }

            if($controller->handle($event, $dispatcher, $arguments) === false){
                return false;
            }
        }

        return true;
    }
}
