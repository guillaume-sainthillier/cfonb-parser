<?php

declare(strict_types=1);

/*
 * This file is part of the CFONB Parser package.
 *
 * (c) SILARHI <dev@silarhi.fr>
 * (c) @fezfez <demonchaux.stephane@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Silarhi\Cfonb\Banking;

use DateTimeImmutable;

class Operation
{
    /** @var string */
    private $bankCode;

    /** @var string|null */
    private $internalCode;

    /** @var string */
    private $deskCode;

    /** @var string|null */
    private $currencyCode;

    /** @var string */
    private $accountNumber;

    /** @var string */
    private $code;

    /** @var DateTimeImmutable */
    private $date;

    /** @var string|null */
    private $rejectCode;

    /** @var DateTimeImmutable */
    private $valueDate;

    /** @var string */
    private $label;

    /** @var string */
    private $reference;

    /** @var string|null */
    private $exemptCode;

    /** @var float */
    private $amount;

    /** @var OperationDetail[] */
    private $details;

    public function __construct(
        string $bankCode,
        string $deskCode,
        string $accountNumber,
        string $code,
        DateTimeImmutable $date,
        DateTimeImmutable $valueDate,
        string $label,
        string $reference,
        float $amount,
        ?string $internalCode,
        ?string $currencyCode,
        ?string $rejectCode,
        ?string $exemptCode
    ) {
        $this->bankCode = $bankCode;
        $this->deskCode = $deskCode;
        $this->accountNumber = $accountNumber;
        $this->code = $code;
        $this->date = $date;
        $this->valueDate = $valueDate;
        $this->label = $label;
        $this->reference = $reference;
        $this->amount = $amount;
        $this->internalCode = $internalCode;
        $this->currencyCode = $currencyCode;
        $this->rejectCode = $rejectCode;
        $this->exemptCode = $exemptCode;
        $this->details = [];
    }

    public function getBankCode(): string
    {
        return $this->bankCode;
    }

    public function getInternalCode(): ?string
    {
        return $this->internalCode;
    }

    public function getDeskCode(): string
    {
        return $this->deskCode;
    }

    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getRejectCode(): ?string
    {
        return $this->rejectCode;
    }

    public function getValueDate(): DateTimeImmutable
    {
        return $this->valueDate;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getExemptCode(): ?string
    {
        return $this->exemptCode;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function addDetails(OperationDetail $details): self
    {
        $this->details[] = $details;

        return $this;
    }

    /** @return OperationDetail[] */
    public function getDetails(): array
    {
        return $this->details;
    }
}
