# socket

Sockets implementation using Expressif streams

## usage :

```php
<?php

  require 'vendor/autoload.php';
  use Expressif\Socket\Server;
  use Expressif\Socket\Client;

  $endpoint = 'tcp://127.0.0.1:1337';
  echo "Starting the server at $endpoint\n";

  $server = new Server($endpoint);
  $server->on('connection', function($client) use() {
    $client->on('data', function($name) use($client) {
      $client->send('Hello '.$name)->close();
    });
  });


  $c = new Client($endpoint);
  $c->send('James Bond')->on('data', function($greetings) {
    echo "<< $greetings\n";
  });
```