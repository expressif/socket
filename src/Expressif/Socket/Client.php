<?php
/**
 * Expressif- stream implementation
 * @author Ioan CHIRIAC
 * @license MIT
 */
namespace Expressif\Socket {

  use Expressif\Stream\Buffer;


  /**
   * Outcomming connection wrapper
   */
  class Client extends Buffer {

    public function __construct($dsn) {
      $socket = stream_socket_client($dsn, $errno, $errstr);
      if (!$socket) {
        throw new \Exception("Unable to bind to $dsn ($errno:$errstr)");
      }
      parent::__construct($socket);
    }

  }

}