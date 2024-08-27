<?php

/*
 * This file is part of Monsieur Biz' Contact Request plugin for Sylius.
 *
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusContactRequestPlugin\Factory;

use MonsieurBiz\SyliusContactRequestPlugin\Entity\ContactRequestInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

/**
 * @method ContactRequestInterface createNew()
 */
interface ContactRequestFactoryInterface extends FactoryInterface
{
    public function createNewFromChannelAndData(ChannelInterface $channel, array $data): ContactRequestInterface;
}
