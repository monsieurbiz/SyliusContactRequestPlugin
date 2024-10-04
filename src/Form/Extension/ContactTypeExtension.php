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
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class ContactTypeExtension extends AbstractTypeExtension
{
    public function __construct(
        private SettingsProviderInterface $settingProvider,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $defaultConstraints = [
            new Assert\Length(['max' => 255]),
        ];

        $requiredConstraints = [
            new Assert\NotBlank(),
            new Assert\Length(['max' => 255]),
        ];

        $isNameRequired = $this->isFieldRequired('field_name_required', 'field_name_displayed');
        $isCompanyRequired = $this->isFieldRequired('field_company_required', 'field_company_displayed');
        $isPhoneNumberRequired = $this->isFieldRequired('field_phone_number_required', 'field_phone_number_displayed');

        $builder
            ->add('name', TextType::class, [
                'label' => 'monsieurbiz.contact_request.form.name',
                'required' => $isNameRequired,
                'constraints' => $isNameRequired ? $requiredConstraints : $defaultConstraints,
            ])
            ->add('company', TextType::class, [
                'label' => 'monsieurbiz.contact_request.form.company',
                'required' => $isCompanyRequired,
                'constraints' => $isCompanyRequired ? $requiredConstraints : $defaultConstraints,
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'monsieurbiz.contact_request.form.phone_number',
                'required' => $isPhoneNumberRequired,
                'constraints' => $isPhoneNumberRequired ? $requiredConstraints : $defaultConstraints,
            ])
        ;
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
}
