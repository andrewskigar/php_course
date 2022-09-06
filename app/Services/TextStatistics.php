<?php

namespace App\Services;

class TextStatistics
{

    protected string $text;
    protected string $reversedText = '';

    protected bool $isPalindrome = false;
    protected int $numberOfCharacters = -1;
    protected int $numberOfWords = -1;
    protected int $numberOfSentences = -1;
    protected int $numberOfPalindromeWords = -1;
    protected int $averageWordLength = -1;
    protected int $averageNumberWordsInSentence = -1;
    protected array $frequencyOfCharacters = [];
    protected array $topUsedWords = [];
    protected array $topLongestWords = [];
    protected array $topShortestWords = [];
    protected array $topLongestSentences = [];
    protected array $topShortestSentences = [];
    protected array $topLongestPalindromeWords  = [];

    protected array $characters = [];
    protected array $words = [];
    protected array $sentences = [];

    protected int $startPoint;
    protected int $endPoint;

    public function __construct()
    {

    }

    public function __call(string $name, array $arguments): int|string|array
    {
        $name = lcfirst(str_replace('get', '', $name));

        return $this->{$name} ?? -1;
    }

    public function calculate(string $text): void
    {
        $this->text = $text;

        $this->startPoint = hrtime(true);

        $this->characters = $this->splitByCharacters($this->text);
        $this->words = $this->splitByWords($this->text);
        $this->sentences = $this->splitBySentences($this->text);
        $this->isPalindrome = $this->isPalindrome($this->text);

        $this->numberOfCharacters();
        $this->numberOfWords();
        $this->numberOfSentences();

        $this->palindromeWords();
        $this->frequencyOfCharacters();
        $this->averageWordLength();
        $this->averageNumberWordsInSentence();

        $this->topUsedWords();
        $this->topLongestWords();
        $this->topShortestWords();
        $this->topLongestSentences();
        $this->topShortestSentences();

        $this->reverseText();

        $this->endPoint = hrtime(true);
    }

    public function tookMs(): float
    {
        return (($this->endPoint - $this->startPoint) / 1e+6);
    }

    protected function splitByCharacters(string $text): array
    {
        return preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    }

    protected function splitByWords(string $text): array
    {
        $onlyWords = [];

        $allWords = preg_split('/(?P<words>[\s,.!?]+)/u', $text, -1, PREG_SPLIT_NO_EMPTY);
        if (count($allWords)) {
            foreach ($allWords as $word) {
                if (mb_strlen($word) > 2) {
                    $onlyWords[] = $word;
                }
            }
        }

        return $onlyWords;
    }

    protected function splitBySentences(string $text): array
    {
        return preg_split('/[.?!]+\K\s+(?=[A-Z])/u', $text, 0, PREG_SPLIT_NO_EMPTY);
    }

    protected function numberOfCharacters(): void
    {
        $this->numberOfCharacters = count($this->characters);
    }

    protected function numberOfWords(): void
    {
        $this->numberOfWords = count($this->words);
    }

    protected function numberOfSentences(): void
    {
        $this->numberOfSentences = count($this->sentences);
    }

    protected function isPalindrome(string $text): bool
    {
        return mb_strtolower($text) === mb_strtolower($this->reverseString($text));
    }

    protected function palindromeWords(): void
    {
        $palindromeWords = [];

        $this->numberOfPalindromeWords = 0;

        foreach ($this->words as $word) {
            if ($this->isPalindrome($word)) {
                $this->numberOfPalindromeWords++;
                $palindromeWords[$word] = mb_strlen($word);
            }
        }

        if (count($palindromeWords) > 0) {
            uasort($palindromeWords, function($a, $b) {
                return $b - $a;
            });

            $this->topLongestPalindromeWords = array_keys(array_slice($palindromeWords, 0 ,10, true));
        }
    }

    protected function frequencyOfCharacters(): void
    {
        $characters = [];
        foreach ($this->characters as $character) {
            if (! isset($characters[$character])) {
                $characters[(string) $character] = 1;
            } else {
                $characters[(string) $character]++;
            }
        }

        uasort($characters, function($a, $b) {
            return $b - $a;
        });

        $this->frequencyOfCharacters = $characters;
    }

    protected function averageWordLength(): void
    {
        $wordsCount = 0;
        $total = 0;
        foreach ($this->words as $word) {
            $total += mb_strlen($word);
            $wordsCount++;
        }
        $this->averageWordLength = (int) ($total / $wordsCount);
    }

    protected function averageNumberWordsInSentence(): void
    {
        $sentencesCount = 0;
        $total = 0;
        foreach ($this->sentences as $sentence) {
            $total += count($this->splitByWords($sentence));
            $sentencesCount++;
        }
        $this->averageNumberWordsInSentence = (int) ($total / $sentencesCount);
    }

    protected function topUsedWords(): void
    {
        $wordsCount = [];
        foreach ($this->words as $word) {
            if (! isset($wordsCount[$word])) {
                $wordsCount[(string) $word] = 1;
            } else {
                $wordsCount[(string) $word]++;
            }
        }

        uasort($wordsCount, function($a, $b) {
           return $b - $a;
        });

        $this->topUsedWords = array_keys(array_slice($wordsCount, 0 ,10, true));
    }

    protected function topLongestWords(): void
    {
        $words = [];
        foreach ($this->words as $word) {
            $words[(string) $word] = mb_strlen($word);
        }

        uasort($words, function($a, $b) {
            return $b - $a;
        });

        $this->topLongestWords = array_keys(array_slice($words, 0 ,10, true));
    }

    protected function topShortestWords(): void
    {
        $words = [];
        foreach ($this->words as $word) {
            $words[(string) $word] = mb_strlen($word);
        }

        uasort($words, function($a, $b) {
            return $a - $b;
        });

        $this->topShortestWords = array_keys(array_slice($words, 0 ,10, true));
    }

    protected function topLongestSentences(): void
    {
        $sentences = [];
        foreach ($this->sentences as $sentence) {
            $sentences[(string) $sentence] = mb_strlen($sentence);
        }

        uasort($sentences, function($a, $b) {
            return $b - $a;
        });

        $this->topLongestSentences = array_keys(array_slice($sentences, 0 ,10, true));
    }

    protected function topShortestSentences(): void
    {
        $sentences = [];
        foreach ($this->sentences as $sentence) {
            $sentences[(string) $sentence] = mb_strlen($sentence);
        }

        uasort($sentences, function($a, $b) {
            return $a - $b;
        });

        $this->topShortestSentences = array_keys(array_slice($sentences, 0 ,10, true));
    }

    protected function reverseText(): void
    {
        $this->reversedText = $this->reverseString($this->text);
    }

    protected function reverseString(string $text): string
    {
        return join('', array_reverse(
            preg_split('~~u', $text, -1, PREG_SPLIT_NO_EMPTY)
        ));
    }
}
