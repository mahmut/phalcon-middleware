<?php
/**
 * author : Mahmut Özdemir
 * web    : www.mahmutozdemir.com.tr
 * email  : bilgi@mahmutozdemir.com.tr
 * ----------------------------------------
 * Date   : 26.09.2022 14:31
 * File   : InterfaceMiddleware.php
 */

namespace Phalcon\Mahmut\Middleware;

use Phalcon\Mvc\Dispatcher;

/**
 * Interface InterfaceMiddleware
 *
 * @package Phalcon\Mahmut\Middleware
 */
interface InterfaceMiddleware
{
    /**
     * @param \Phalcon\Events\Event $event
     * @param Dispatcher $dispatcher
     * @param array $params
     * @return bool
     */
    public function handle(\Phalcon\Events\Event $event, Dispatcher $dispatcher, array $params = []): bool;
}
