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

use Generator;
use Silarhi\Cfonb\Banking\Element;
use Silarhi\Cfonb\Contracts\ParserInterface;
use Silarhi\Cfonb\Exceptions\ParseException;

use function sprintf;
use function strlen;

/** @internal */
final readonly class FileParser
{
    /** @var ParserInterface[] */
    private array $parsers;

    public function __construct(ParserInterface ...$parsers)
    {
        $this->parsers = $parsers;
    }

    /**
     * @param positive-int $lineLength
     *
     * @return Generator<int, Element>
     */
    public function parse(string $content, int $lineLength, bool $strict): iterable
    {
        $content = ltrim(rtrim(str_replace("\r\n", "\n", $content), "\n"), "\n");

        if (empty($content)) {
            return [];
        }

        if (strlen($content) > $lineLength && !str_contains($content, "\n")) {
            $content = chunk_split($content, $lineLength, "\n");
        }

        foreach (explode("\n", $content) as $line) {
            yield $this->findSupportedParserForLine($line)->parse($line, $strict);
        }
    }

    private function findSupportedParserForLine(string $line): ParserInterface
    {
        foreach ($this->parsers as $parser) {
            if ($parser->supports($line)) {
                return $parser;
            }
        }

        throw new ParseException(sprintf("Unable to find a parser for the line :\n\"%s\"", $line));
    }
}
