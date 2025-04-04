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

namespace MonsieurBiz\SyliusContactRequestPlugin\Form\Extension;

use MonsieurBiz\SyliusSettingsPlugin\Provider\SettingsProviderInterface;
use Sylius\Bundle\CoreBundle\Form\Type\ContactType;
use Sylius\Component\Customer\Context\CustomerContextInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints as Assert;

final class ContactTypeExtension extends AbstractTypeExtension
{
    public function __construct(
        private SettingsProviderInterface $settingProvider,
        private CustomerContextInterface $customerContext,
    ) {
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $isNameRequired = $this->isFieldRequired('field_name_required', 'field_name_displayed');
        $isCompanyRequired = $this->isFieldRequired('field_company_required', 'field_company_displayed');
        $isPhoneNumberRequired = $this->isFieldRequired('field_phone_number_required', 'field_phone_number_displayed');

        $builder
            ->add('name', TextType::class, [
                'label' => 'monsieurbiz.contact_request.form.name',
                'required' => $isNameRequired,
                'constraints' => $this->getConstraints($isNameRequired, 'monsieurbiz.contact_request.name.not_blank'),
            ])
            ->add('company', TextType::class, [
                'label' => 'monsieurbiz.contact_request.form.company',
                'required' => $isCompanyRequired,
                'constraints' => $this->getConstraints($isCompanyRequired, 'monsieurbiz.contact_request.company.not_blank'),
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'monsieurbiz.contact_request.form.phone_number',
                'invalid_message' => 'monsieurbiz.contact_request.phone_number.invalid',
                'required' => $isPhoneNumberRequired,
                'constraints' => $this->getConstraints($isPhoneNumberRequired, 'monsieurbiz.contact_request.phone_number.not_blank'),
            ])
        ;

        $isConfirmationFieldDisplayed = (bool) $this->settingProvider->getSettingValue('monsieurbiz_contact_request.contact', 'field_confirmation_displayed');
        if ($isConfirmationFieldDisplayed) {
            $confirmationFieldLabel = (string) $this->settingProvider->getSettingValue('monsieurbiz_contact_request.contact', 'field_confirmation_label');
            $confirmationFieldLabel = empty($confirmationFieldLabel) ? 'monsieurbiz.contact_request.form.confirmation_default_label' : $confirmationFieldLabel;
            $builder->add('confirmation', CheckboxType::class, [
                'label' => $confirmationFieldLabel,
                'label_html' => true,
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'monsieurbiz.contact_request.confirmation_error',
                    ]),
                ],
            ]);
        }

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
            $name = $this->customerContext->getCustomer()?->getFullName();
            if (null === $name) {
                return;
            }

            /** @var array $data */
            $data = $event->getData();
            $data['name'] = $name;

            $event->setData($data);
        });
    }

    public static function getExtendedTypes(): iterable
    {
        return [
            ContactType::class,
        ];
    }

    private function isFieldRequired(string $path, string $pathDisplayed): bool
    {
        return $this->settingProvider->getSettingValue('monsieurbiz_contact_request.contact', $path)
            && $this->settingProvider->getSettingValue('monsieurbiz_contact_request.contact', $pathDisplayed);
    }

    private function getConstraints(bool $isRequired, ?string $blankMessage): array
    {
        return $isRequired ? [
            new Assert\NotBlank([
                'message' => $blankMessage,
            ]),
            new Assert\Length(['max' => 255]),
        ] : [
            new Assert\Length(['max' => 255]),
        ];
    }
}
