<?php

namespace Lhpalacio\Wallet\Domain;

use Money\Money;

class DepositWasMade
{
    /**
     * @var Money
     */
    private $amount;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * DepositWasMade constructor.
     * @param Money $amount
     */
    public function __construct(Money $amount)
    {
        $this->amount = $amount;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return Money
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
