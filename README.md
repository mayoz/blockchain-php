# Blockchain

Let's start by creating a new simple example for understanding the cycle:

```php
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
```

## Testing

You will need an install of [Composer](https://getcomposer.org/) before continuing.

First, install the dependencies:

```bash
$ composer install
```

Then run PHPUnit:

```bash
$ vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
