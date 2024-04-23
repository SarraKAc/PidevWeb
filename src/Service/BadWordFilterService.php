<?php

namespace App\Service;

class BadWordFilterService
{
    private $badWords;

    public function __construct(array $badWords)
    {
        $this->badWords = $badWords;
    }

    public function containsBadWords(string $comment): bool
    {
        foreach ($this->badWords as $badWord) {
            if (stripos($comment, $badWord) !== false) {
                return true;
            }
        }
        return false;
    }
}