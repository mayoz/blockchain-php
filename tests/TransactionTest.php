<?php

namespace Mayoz\Blockchain;

class TransactionTest extends TestCase
{
    public function testConstructor()
    {
        $from = 'foo';
        $to = 'bar';
        $amount = 100.10;

        $transaction = new Transaction($from, $to, $amount);

        $this->assertSame($from, $transaction->from);
        $this->assertSame($to, $transaction->to);
        $this->assertSame($amount, $transaction->amount);
    }
}
