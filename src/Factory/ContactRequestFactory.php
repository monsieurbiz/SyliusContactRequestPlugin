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

final class ContactRequestFactory implements ContactRequestFactoryInterface
{
    public function __construct(private FactoryInterface $factory)
    {
    }

    public function createNew(): ContactRequestInterface
    {
        // @phpstan-ignore-next-line
        return $this->factory->createNew();
    }

    public function createNewFromChannelAndData(ChannelInterface $channel, array $data): ContactRequestInterface
    {
        $contactRequest = $this->createNew();
        $contactRequest->setEmail($data['email']);
        $contactRequest->setMessage($data['message']);
        $contactRequest->setName($data['name'] ?? null);
        $contactRequest->setCompany($data['company'] ?? null);
        $contactRequest->setPhoneNumber($data['phoneNumber'] ?? null);
        $contactRequest->setChannel($channel);

        return $contactRequest;
    }
}
