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

use Silarhi\Cfonb\Banking\Header;
use Silarhi\Cfonb\Banking\Total;
use Silarhi\Cfonb\Banking\Transaction;
use Silarhi\Cfonb\Banking\Transfer;
use Silarhi\Cfonb\Exceptions\ParseException;
use Silarhi\Cfonb\Parser\Cfonb240\Line31Parser;
use Silarhi\Cfonb\Parser\Cfonb240\Line34Parser;
use Silarhi\Cfonb\Parser\Cfonb240\Line39Parser;
use Silarhi\Cfonb\Parser\EmptyParser;
use Silarhi\Cfonb\Parser\FileParser;

class Cfonb240Reader
{
    const LINE_LENGTH = 240;

    /** @var FileParser */
    private $fileParser;

    public function __construct()
    {
        $this->fileParser = new FileParser(
            new Line31Parser(),
            new Line34Parser(),
            new Line39Parser(),
            new EmptyParser()
        );
    }

    /** @return Transfer[] */
    public function parse(string $content): array
    {
        $instance = null;
        $list = [];

        foreach ($this->fileParser->parse($content, self::LINE_LENGTH) as $result) {
            if ($result instanceof Header) {
                $instance = new Transfer();
                $instance->setHeader($result);
            } elseif ($result instanceof Total) {
                if (null === $instance) {
                    throw new ParseException(sprintf('Unable to attach a total for operation with internal code %s', $result->getSequenceNumber()));
                }
                $instance->setTotal($result);
                $list[] = $instance;
            } elseif ($result instanceof Transaction) {
                if (null === $instance) {
                    throw new ParseException(sprintf('Unable to attach a total for operation with internal code %s', $result->getSequenceNumber()));
                }
                $instance->addTransaction($result);
            }
        }

        return $list;
    }
}
