<?php

namespace Mayoz\Blockchain;

class Block
{
    /**
     * The timestamp value.
     *
     * @var int
     */
    public $timestamp;

    /**
     * The list of block transactions.
     *
     * @var array
     */
    public $transactions = [];

    /**
     * The block hash.
     *
     * @var string
     */
    public $hash;

    /**
     * The proof of work value.
     *
     * @var int
     */
    public $nonce = 0;

    /**
     * The previous block hash.
     *
     * @var string
     */
    public $previousHash;

    /**
     * Create a new Block instance.
     *
     * @param  int  $timestamp
     * @param  array  $transactions
     * @param  string  $previousHash
     * @return void
     */
    public function __construct($timestamp, array $transactions, $previousHash = null)
    {
        $this->timestamp = $timestamp;
        $this->transactions = $transactions;
        $this->previousHash = $previousHash;
    }

    /**
     * Returns the generated block hash.
     *
     * @return string
     */
    public function generateHash()
    {
        return hash('sha256', json_encode([
            'timestamp' => $this->timestamp,
            'transactions' => $this->transactions,
            'nonce' => $this->nonce,
            'previousHash' => $this->previousHash,
        ]));
    }

    /**
     * Generate a new correct hash by mining.
     *
     * @return void
     */
    public function mine()
    {
        while(! $this->verify()) {
            $this->nonce++;

            $this->hash = $this->generateHash();
        }
    }

    /**
     * Determine whether the generated hash is valid.
     *
     * @return bool
     */
    public function verify()
    {
        return substr($this->hash, 0, 2) === str_pad('', 2, '0');
    }

    /**
     * Determine whether the current block is valid.
     *
     * @return bool
     */
    public function validate(Block $previous)
    {
        return ($this->hash == $this->generateHash())
            && ($this->previousHash == $previous->hash);
    }
}
