<?php

namespace Lhpalacio\Wallet\Domain;

use Ramsey\Uuid\UuidInterface;

class WalletWasCreated
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * WalletWasCreated constructor.
     * @param UuidInterface $id
     */
    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return UuidInterface
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
