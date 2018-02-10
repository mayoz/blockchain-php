<?php

namespace Mayoz\Blockchain;

class BlockchainTest extends TestCase
{
    public function testConstructor()
    {
        $blockchain = new Blockchain;

        $this->assertCount(1, $blockchain->chain);
        $this->assertCount(0, $blockchain->pendingData);
        $this->assertInstanceOf(Block::class, $blockchain->latest());
    }

    public function testLatestChain()
    {
        $blockchain = new Blockchain;

        $block1 = $blockchain->chain[] = new Block(strtotime('2018-02-09'), []);
        $block2 = $blockchain->chain[] = new Block(strtotime('2018-02-10'), []);

        $this->assertEquals($block2, $blockchain->latest());
    }

    public function testTransaction()
    {
        $blockchain = new Blockchain;

        $blockchain->transaction(new Transaction('foo', 'bar', 10));
        $blockchain->transaction(new Transaction('bar', 'baz', 20));

        $this->assertCount(2, $blockchain->pendingData);
    }

    public function testMine()
    {
        $blockchain = new Blockchain;

        $mined1 = $blockchain->mine('foo');
        $mined2 = $blockchain->mine('foo');

        $this->assertTrue($blockchain->validate());
    }

    public function testInvalidMining()
    {
        $blockchain = new Blockchain;

        $mined1 = $blockchain->mine('foo');
        $mined2 = $blockchain->mine('foo');

        $mined1->hash = 'invalid-hash-string';

        $this->assertFalse($blockchain->validate());
    }

    public function testMinerData()
    {
        $blockchain = new Blockchain;

        $block = $blockchain->mine('foo');

        $this->assertEquals(null, $blockchain->pendingData[0]->from);
        $this->assertEquals('foo', $blockchain->pendingData[0]->to);
        $this->assertEquals($blockchain->reward, $blockchain->pendingData[0]->amount);
    }
}
