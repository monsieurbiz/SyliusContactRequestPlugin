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

namespace MonsieurBiz\SyliusContactRequestPlugin\EmailManager;

use Doctrine\ORM\EntityManagerInterface;
use MonsieurBiz\SyliusContactRequestPlugin\Factory\ContactRequestFactoryInterface;
use Sylius\Bundle\ShopBundle\EmailManager\ContactEmailManagerInterface;
use Sylius\Component\Core\Model\ChannelInterface;

final class DecorateContactEmailManager implements ContactEmailManagerInterface
{
    public function __construct(
        private ContactEmailManagerInterface $decoratedContactEmailManager,
        private ContactRequestFactoryInterface $contactRequestFactory,
        private EntityManagerInterface $contactRequestManager,
    ) {
    }

    public function sendContactRequest(array $data, array $recipients, ChannelInterface $channel = null, string $localeCode = null): void
    {
        $this->decoratedContactEmailManager->sendContactRequest($data, $recipients, $channel, $localeCode);

        if (null === $channel) {
            return;
        }

        $contactRequest = $this->contactRequestFactory->createNewFromChannelAndData($channel, $data);
        $this->contactRequestManager->persist($contactRequest);
        $this->contactRequestManager->flush();
    }
}
