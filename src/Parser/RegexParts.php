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

namespace Silarhi\Cfonb\Parser;

use function sprintf;

/** @internal */
class RegexParts
{
    public function __construct(
        private readonly string $regexParts,
        private readonly ?int $length = null,
        private readonly bool $matching = true,
    ) {
    }

    public function isMatching(): bool
    {
        return $this->matching;
    }

    public function toString(): string
    {
        if (null === $this->length) {
            return $this->regexParts;
        }

        return sprintf($this->regexParts, $this->length);
    }
}
