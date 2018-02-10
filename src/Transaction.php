<?php

namespace Mayoz\Blockchain;

class Transaction
{
    /**
     * The sender address.
     *
     * @var string
     */
    public $from;

    /**
     * The recipient address.
     *
     * @var string
     */
    public $to;

    /**
     * The amount value.
     *
     * @var float
     */
    public $amount;

    /**
     * Create a new transaction instance.
     *
     * @param  string  $from
     * @param  string  $to
     * @param  float  $amount
     * @return void
     */
    public function __construct($from, $to, $amount)
    {
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
    }
}
