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

namespace MonsieurBiz\SyliusContactRequestPlugin\Menu;

use MonsieurBiz\SyliusMenuPlugin\Provider\AbstractUrlProvider;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactUrlProvider extends AbstractUrlProvider
{
    public const PROVIDER_CODE = 'contact';

    protected string $code = self::PROVIDER_CODE;

    protected string $icon = 'phone';

    protected int $priority = 900;

    public function __construct(
        RouterInterface $router,
        private TranslatorInterface $translator
    ) {
        parent::__construct($router);
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function getResults(string $locale, string $search = ''): iterable
    {
        return [
            (object) [
                'title' => $this->translator->trans('monsieurbiz.contact_request.ui.contact_page', [], 'messages', $locale),
            ],
        ];
    }

    protected function addItemFromResult(object $result, string $locale): void
    {
        $this->addItem(
            (string) $result->title,
            $this->router->generate('sylius_shop_contact_request', ['_locale' => $locale])
        );
    }
}
