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
use MonsieurBiz\SyliusSettingsPlugin\Provider\SettingsProviderInterface;
use Sylius\Bundle\ShopBundle\EmailManager\ContactEmailManagerInterface;
use Sylius\Component\Core\Model\ChannelInterface;

final class DecorateContactEmailManager implements ContactEmailManagerInterface
{
    public function __construct(
        private ContactEmailManagerInterface $decoratedContactEmailManager,
        private ContactRequestFactoryInterface $contactRequestFactory,
        private EntityManagerInterface $contactRequestManager,
        private SettingsProviderInterface $settingProvider,
    ) {
    }

    public function sendContactRequest(array $data, array $recipients, ChannelInterface $channel = null, string $localeCode = null): void
    {
        $settingRecipients = $this->getContactRequestEmailRecipients();
        if (!empty($settingRecipients)) {
            $recipients = $settingRecipients;
        }

        $this->decoratedContactEmailManager->sendContactRequest($data, $recipients, $channel, $localeCode);

        if (null === $channel) {
            return;
        }

        $contactRequest = $this->contactRequestFactory->createNewFromChannelAndData($channel, $data);
        $this->contactRequestManager->persist($contactRequest);
        $this->contactRequestManager->flush();
    }

    private function getContactRequestEmailRecipients(): array
    {
        $emailRecipients = $this->settingProvider->getSettingValue('monsieurbiz_contact_request.contact', 'email_recipients');

        return array_unique(array_filter(array_map('trim', explode(',', (string) $emailRecipients))));
    }
}
