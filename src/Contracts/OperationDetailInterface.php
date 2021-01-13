<?php

/*
 * This file is part of the CFONB Parser package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Silarhi\Cfonb\Contracts;

use DateTimeInterface;

/**
 * Interface OperationDetailInterface specifies general methods for model,
 * those will not changed for the version.
 */
interface OperationDetailInterface
{
    public function getBankCode(): string;

    public function getInternalCode(): ?string;

    public function getDeskCode(): string;

    public function getCurrencyCode(): ?string;

    public function getAccountNumber(): string;

    public function getCode(): string;

    public function getDate(): DateTimeInterface;

    public function getAdditionalInformations(): string;

    public function getQualifier(): string;
}
