<?php

include 'vendor/autoload.php';

use Lhpalacio\Wallet\Domain\Wallet;
use Ramsey\Uuid\Uuid;
use Money\Money;
use Money\Currency;
use Lhpalacio\Wallet\Domain\WalletWasCreated;
use Lhpalacio\Wallet\Domain\DepositWasMade;

/** @var Wallet $wallet */
$wallet = Wallet::create(Uuid::uuid4());

echo 'Wallet created at: ' . $wallet->getCreatedAt()->format('d/m/Y H:i:s') . PHP_EOL;
echo 'Balance: ' . $wallet->getBalance()->getAmount() . PHP_EOL;

$wallet->deposit(new Money(100, new Currency('BRL')));
echo 'Added funds in wallet' . PHP_EOL;
echo 'Balance: ' . $wallet->getBalance()->getAmount() . PHP_EOL;

echo 'Rebuild wallet from events:' . PHP_EOL;

$events = []; // $events = $this->eventStore->eventsForAggregate($walletId);

$events[] = new WalletWasCreated(Uuid::uuid4());
$events[] = new DepositWasMade(new Money(10, new Currency('BRL')));
$events[] = new DepositWasMade(new Money(15, new Currency('BRL')));
$events[] = new DepositWasMade(new Money(100, new Currency('BRL')));

$wallet = Wallet::rebuildFromEvents($events);

echo 'Wallet created at: ' . $wallet->getCreatedAt()->format('d/m/Y H:i:s') . PHP_EOL;
echo 'Balance: ' . $wallet->getBalance()->getAmount() . PHP_EOL;