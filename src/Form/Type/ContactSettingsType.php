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

namespace MonsieurBiz\SyliusContactRequestPlugin\Form\Type;

use MonsieurBiz\SyliusRichEditorPlugin\Form\Type\RichEditorType;
use MonsieurBiz\SyliusSettingsPlugin\Form\AbstractSettingsType;
use MonsieurBiz\SyliusSettingsPlugin\Form\SettingsTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class ContactSettingsType extends AbstractSettingsType implements SettingsTypeInterface
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addWithDefaultCheckbox(
            $builder,
            'content_before_form',
            RichEditorType::class,
            [
                'label' => 'monsieurbiz.contact_request.ui.content_before_form',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'content_after_form',
            RichEditorType::class,
            [
                'label' => 'monsieurbiz.contact_request.ui.content_after_form',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'email_recipients',
            TextType::class,
            [
                'label' => 'monsieurbiz.contact_request.ui.email_recipients',
                'help' => 'monsieurbiz.contact_request.ui.email_recipients_help',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'phone_number',
            TextType::class,
            [
                'label' => 'monsieurbiz.contact_request.ui.phone_number',
                'help' => 'monsieurbiz.contact_request.ui.phone_number_help',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'field_name_displayed',
            CheckboxType::class,
            [
                'label' => 'monsieurbiz.contact_request.settings.field_name_displayed',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'field_name_required',
            CheckboxType::class,
            [
                'label' => 'monsieurbiz.contact_request.settings.field_name_required',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'field_company_displayed',
            CheckboxType::class,
            [
                'label' => 'monsieurbiz.contact_request.settings.field_company_displayed',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'field_company_required',
            CheckboxType::class,
            [
                'label' => 'monsieurbiz.contact_request.settings.field_company_required',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'field_phone_number_displayed',
            CheckboxType::class,
            [
                'label' => 'monsieurbiz.contact_request.settings.field_phone_number_displayed',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'field_phone_number_required',
            CheckboxType::class,
            [
                'label' => 'monsieurbiz.contact_request.settings.field_phone_number_required',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'field_confirmation_displayed',
            CheckboxType::class,
            [
                'label' => 'monsieurbiz.contact_request.settings.field_confirmation_displayed',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'field_confirmation_label',
            TextareaType::class,
            [
                'label' => 'monsieurbiz.contact_request.settings.field_confirmation_label',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'breadcrumbs_title',
            TextType::class,
            [
                'label' => 'monsieurbiz.contact_request.ui.breadcrumbs_title',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'meta_title',
            TextType::class,
            [
                'label' => 'monsieurbiz.contact_request.ui.meta_title',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'meta_description',
            TextType::class,
            [
                'label' => 'monsieurbiz.contact_request.ui.meta_description',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'meta_keywords',
            TextType::class,
            [
                'label' => 'monsieurbiz.contact_request.ui.meta_keywords',
                'required' => false,
            ]
        );
        $this->addWithDefaultCheckbox(
            $builder,
            'hide_sylius_default_content',
            CheckboxType::class,
            [
                'label' => 'monsieurbiz.contact_request.ui.hide_sylius_default_content',
                'required' => false,
            ]
        );
    }
}
