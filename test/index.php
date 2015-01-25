<?php

require __DIR__ . '/../vendor/autoload.php';
use Expressif\Socket\Server;
use Expressif\Socket\Client;

$endpoint = 'tcp://127.0.0.1:1337';
echo "Chatting at $endpoint\n";

$i = 0;
$peoples = ['john', 'jerry', 'sam', 'harry', 'ben'];


$server = new Server($endpoint);
$server->on('connection', function($c) use(&$i, $server) {
  $c->on('data', function($name) use($c, &$i, $server) {
    $i++;
    $c->send('Hello '.$name)->close();
    if ($i == 5) {
      echo "--> Server has done its job !\n";
      $server->close();
    }
  });
});



foreach($peoples as $who) {
  echo ">> $who talk\n";
  $c = new Client($endpoint);
  $c->send($who)->on('data', function($greetings) {
    echo "<< $greetings\n";
  });
}