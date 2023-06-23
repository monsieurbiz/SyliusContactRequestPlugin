<?php

/*
 * This file is part of Monsieur Biz' Contact Request plugin for Sylius.
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusContactRequestPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function __invoke(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $customerMenu = $menu->getChild('customers');

        $customerMenu?->addChild('monsieurbiz-contact-request', ['route' => 'monsieurbiz_contact_request_admin_contact_request_index'])
            ->setLabel('monsieurbiz.contact_request.ui.contact_requests')
            ->setLabelAttribute('icon', 'phone')
        ;
    }
}
