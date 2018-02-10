<?php

namespace Mayoz\Blockchain;

class Blockchain
{
    /**
     * The list of confirmed blocks.
     *
     * @var array
     */
    public $chain = [];

    /**
     * The list of to be processed data.
     *
     * @var array
     */
    public $pendingData = [];

    /**
     * The value of reward price.
     *
     * @var float
     */
    public $reward = 100;

    /**
     * Create a new blockchain instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->boot();
    }

    /**
     * Booting the new blockchain.
     *
     * @return void
     */
    protected function boot()
    {
        $this->chain = [new Block(strtotime('now'), [])];
        $this->pendingData = [];
    }

    /**
     * Get the latest block in the chain.
     *
     * @return Block
     */
    public function latest()
    {
        return end($this->chain);
    }

    /**
     * Push a new data for the pending block.
     *
     * @param  Transaction  $data
     * @return void
     */
    public function transaction(Transaction $data)
    {
        $this->pendingData[] = $data;
    }

    /**
     * Mine the pending transactions.
     *
     * @param  string  $minerAddress
     * @return Block
     */
    public function mine($minerAddress)
    {
        $block = new Block(strtotime('now'), $this->pendingData, $this->latest()->hash);
        $block->mine();

        $this->chain[] = $block;

        $this->pendingData = [
            new Transaction(null, $minerAddress, $this->reward)
        ];

        return $block;
    }

    /**
     * Determine whether the chain is valid.
     *
     * @return bool
     */
    public function validate()
    {
        for ($i = 1; $i < count($this->chain); $i++) {
            if (! $this->chain[$i]->validate($this->chain[$i - 1])) {
                return false;
            }
        }

        return true;
    }
}
