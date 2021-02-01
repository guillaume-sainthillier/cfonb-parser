<?php

declare(strict_types=1);

/*
 * This file is part of the CFONB Parser package.
 *
 * (c) Guillaume Sainthillier <hello@silarhi.fr>
 * (c) @fezfez <demonchaux.stephane@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Silarhi\Cfonb;

use Silarhi\Cfonb\Banking\Statement;
use Silarhi\Cfonb\Banking\Transfer;

class CfonbReader
{
    /** @var Cfonb120Reader */
    private $cfonb120Reader;
    /** @var Cfonb240Reader */
    private $cfonb240Reader;

    public function __construct(Cfonb120Reader $cfonb120Reader = null, Cfonb240Reader $cfonb240Reader = null)
    {
        $this->cfonb120Reader = null === $cfonb120Reader ? new Cfonb120Reader() : $cfonb120Reader;
        $this->cfonb240Reader = null === $cfonb240Reader ? new Cfonb240Reader() : $cfonb240Reader;
    }

    /** @return Statement[] */
    public function parseCfonb120(string $content): array
    {
        return $this->cfonb120Reader->parse($content);
    }

    /** @return Transfer[] */
    public function parseCfonb240(string $content): array
    {
        return $this->cfonb240Reader->parse($content);
    }
}
