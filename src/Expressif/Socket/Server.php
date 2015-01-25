<?php
/**
 * Expressif- stream implementation
 * @author Ioan CHIRIAC
 * @license MIT
 */
namespace Expressif\Socket {

  use Expressif\Stream\Event;


  /**
   * Event wrapper
   */
  class Server extends Event {
    public function __construct($dsn) {
      $socket = stream_socket_server($dsn, $errno, $errstr);
      if (!$socket) {
        throw new \Exception("Unable to bind to $dsn ($errno:$errstr)");
      }
      parent::__construct($socket);
    }

    /**
     * Handles the connection
     */
    public function _trigger() {
      $client = $this->accept();
      if ($client) parent::emit('connection', array($client));
    }

    /**
     * Accept the incomming connection
     */
    public function accept() {
      $socket = stream_socket_accept($this->stream);
      if ($socket) {
        return new Connection($this, $socket);
      }
    }
  }
}