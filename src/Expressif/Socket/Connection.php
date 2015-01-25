<?php
/**
 * Expressif- stream implementation
 * @author Ioan CHIRIAC
 * @license MIT
 */
namespace Expressif\Socket {

  use Expressif\Stream\Buffer;


  /**
   * Incomming connection wrapper
   */
  class Connection extends Buffer {
    protected $server;
    public function __construct(Server $server, $socket) {
      $this->server = $server;
      parent::__construct($socket);
    }
  }

}