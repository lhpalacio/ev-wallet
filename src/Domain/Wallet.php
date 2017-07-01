<?php

namespace Lhpalacio\Wallet\Domain;

use Money\Currency;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

class Wallet
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var Money
     */
    private $balance;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \ArrayObject
     */
    private $events;

    /**
     * @return UuidInterface
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Money
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param UuidInterface $id
     * @return static
     */
    public static function create(UuidInterface $id)
    {
        $wallet = new static;
        $wallet->raise(new WalletWasCreated($id));

        return $wallet;
    }

    /**
     * @param Money $amount
     */
    public function deposit(Money $amount)
    {
        $this->raise(new DepositWasMade($amount));
    }

    /**
     * @param $event
     */
    private function raise($event)
    {
        $this->apply($event);

        $this->events[] = $event;
    }

    /**
     * @param $events
     * @return static
     */
    public static function rebuildFromEvents($events)
    {
        $wallet = new static;

        foreach($events as $event) {
            $wallet->apply($event);
        }

        return $wallet;
    }

    /**
     * @param $event
     */
    private function apply($event)
    {
        switch (get_class($event)) {
            case WalletWasCreated::class :
                $this->id = $event->getId();
                $this->balance = new Money(0, new Currency('BRL'));
                $this->createdAt = $event->getCreatedAt();
                break;
            case DepositWasMade::class :
                $this->balance = $this->balance->add($event->getAmount());
                break;
        }
    }
}