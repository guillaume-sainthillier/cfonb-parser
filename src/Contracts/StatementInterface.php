<?php

/*
 * This file is part of the CFONB Parser package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Silarhi\Cfonb\Contracts;

/**
 * Interface StatementInterface specifies general methods for model,
 * those will not changed for the version.
 */
interface StatementInterface
{

    /**
     * @return bool
     */
    public function hasOldBalance(): bool;

    /**
     * @return BalanceInterface
     */
    public function getOldBalance(): BalanceInterface;

    /**
     * @return bool
     */
    public function hasNewBalance(): bool;

    /**
     * @return BalanceInterface
     */
    public function getNewBalance(): BalanceInterface;

    /**
     * @return OperationInterface[]
     */
    public function getOperations(): array;
}
