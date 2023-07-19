<?php

/*
 * This file is part of Monsieur Biz' Contact Request plugin for Sylius.
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusContactRequestPlugin\EmailManager;

use Doctrine\ORM\EntityManagerInterface;
use MonsieurBiz\SyliusContactRequestPlugin\Entity\ContactRequestInterface;
use Sylius\Bundle\ShopBundle\EmailManager\ContactEmailManagerInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

final class DecorateContactEmailManager implements ContactEmailManagerInterface
{
    public function __construct(
        private ContactEmailManagerInterface $decoratedContactEmailManager,
        private FactoryInterface $contactRequestFactory,
        private EntityManagerInterface $contactRequestManager,
    ) {
    }

    public function sendContactRequest(array $data, array $recipients, ChannelInterface $channel = null, string $localeCode = null): void
    {
        $this->decoratedContactEmailManager->sendContactRequest($data, $recipients, $channel, $localeCode);

        if (null === $channel) {
            return;
        }

        /** @var ContactRequestInterface $contactRequest */
        $contactRequest = $this->contactRequestFactory->createNew();
        $contactRequest->setEmail($data['email']);
        $contactRequest->setMessage($data['message']);
        $contactRequest->setChannel($channel);

        $this->contactRequestManager->persist($contactRequest);
        $this->contactRequestManager->flush();
    }
}
