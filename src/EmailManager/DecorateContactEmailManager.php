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
use Sylius\Bundle\CoreBundle\Mailer\ContactEmailManagerInterface;
use Sylius\Bundle\ShopBundle\EmailManager\ContactEmailManagerInterface as OldContactEmailManagerInterface;
use Sylius\Component\Core\Model\ChannelInterface;

final class DecorateContactEmailManager implements ContactEmailManagerInterface
{
    public function __construct(
        private OldContactEmailManagerInterface|ContactEmailManagerInterface $decoratedContactEmailManager,
        private ContactRequestFactoryInterface $contactRequestFactory,
        private EntityManagerInterface $contactRequestManager,
        private SettingsProviderInterface $settingProvider,
    ) {
        if ($this->decoratedContactEmailManager instanceof OldContactEmailManagerInterface) {
            trigger_deprecation(
                'sylius/shop-bundle',
                '1.13',
                'The "%s" interface is deprecated, use "%s" instead.',
                OldContactEmailManagerInterface::class,
                ContactEmailManagerInterface::class,
            );
        }
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
