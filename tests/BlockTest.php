<?php

namespace Mayoz\Blockchain;

class BlockTest extends TestCase
{
    public function testConstructor()
    {
        $timestamp = strtotime('now');
        $transactions = [];
        $previousHash = null;

        $block = new Block($timestamp, $transactions, $previousHash);

        $this->assertSame($timestamp, $block->timestamp);
        $this->assertSame($transactions, $block->transactions);
        $this->assertSame($previousHash, $block->previousHash);
    }

    public function testGeneratedHashMustBeSha256()
    {
        $block = new Block(strtotime('2018-02-10'), []);

        $hash = 'a247f8627c3a6a82a52b179d8bb6846f4c9d81df08d0fc19b6d0ce696a807316';

        $this->assertSame($hash, $block->generateHash());
    }

    public function testVerifyMethod()
    {
        $block = new Block(strtotime('2018-02-10'), []);
        $block->hash = 'a247f8627c3a6a82a52b179d8bb6846f4c9d81df08d0fc19b6d0ce696a807316';

        $this->assertFalse($block->verify());

        $block = new Block(strtotime('2018-02-10'), []);
        $block->hash = '0000000000000000000000000000000000000000000000000000000000000000';

        $this->assertTrue($block->verify());
    }

    public function testValidateMethod()
    {
        $first = new Block(strtotime('2018-02-10'), []);
        $first->hash = 'a247f8627c3a6a82a52b179d8bb6846f4c9d81df08d0fc19b6d0ce696a807316';

        $second = new Block(strtotime('2018-02-10'), [], $first->hash);
        $second->hash = 'fbcc3621b5458a451f8a6b17027df7dd6483cdd07ddcf0abfe575d7929e1395a';

        $this->assertTrue($second->validate($first));
    }

    public function testMineMethod()
    {
        $block = new Block(strtotime('2018-02-10'), []);

        $block->mine();

        $this->assertTrue($block->verify());
    }
}
