<?php

include 'vendor/autoload.php';

use Mayoz\Blockchain\Blockchain;
use Mayoz\Blockchain\Transaction;

// create main blockchain instance
$blockchain = new Blockchain;

// add new transactions to pending chain
$blockchain->transaction(new Transaction('foo', 'bar', 10));
$blockchain->transaction(new Transaction('foo', 'baz', 20));

// mine the pending chain
$block = $blockchain->mine('miner-address');

var_dump($block->hash);

// add new transactions to new pending chain
$blockchain->transaction(new Transaction('baz', 'bar', 15));

// and mine it
$block = $blockchain->mine('miner-address');

var_dump($block->hash);
