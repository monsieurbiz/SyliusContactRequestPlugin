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

namespace MonsieurBiz\SyliusContactRequestPlugin\Entity;

use DateTimeInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface ContactRequestInterface extends ResourceInterface, TimestampableInterface
{
    public function getId(): ?int;

    public function getEmail(): ?string;

    public function setEmail(?string $email): void;

    public function getMessage(): ?string;

    public function setMessage(?string $message): void;

    public function getChannel(): ?ChannelInterface;

    public function setChannel(?ChannelInterface $channel): void;

    public function getCreatedAt(): ?DateTimeInterface;

    public function setCreatedAt(?DateTimeInterface $createdAt): void;

    public function getUpdatedAt(): ?DateTimeInterface;

    public function setUpdatedAt(?DateTimeInterface $updatedAt): void;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getCompany(): ?string;

    public function setCompany(?string $company): void;

    public function getPhoneNumber(): ?string;

    public function setPhoneNumber(?string $phoneNumber): void;
}
