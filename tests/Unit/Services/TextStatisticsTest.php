<?php

namespace Tests\Unit\Services;

use App\Services\TextStatistics;
use PHPUnit\Framework\TestCase;

class TextStatisticsTest extends TestCase
{
    protected TextStatistics $textStatisticsService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->textStatisticsService = new TextStatistics();
    }

    public function test_it_can_return_number_of_characters()
    {
        $this->textStatisticsService->calculate('Five');
        $this->assertEquals(4, $this->textStatisticsService->getNumberOfCharacters());
    }

    public function test_it_can_return_number_of_words()
    {
        $this->textStatisticsService->calculate('Two words!');
        $this->assertEquals(2, $this->textStatisticsService->getNumberOfWords());
    }

    public function test_it_can_return_number_of_sentences()
    {
        $this->textStatisticsService->calculate('One. Two! Three');
        $this->assertEquals(3, $this->textStatisticsService->getNumberOfSentences());
    }

    public function test_it_can_return_number_of_palindrome_words()
    {
        $this->textStatisticsService->calculate('Wow, this is noon. Peep.');
        $this->assertEquals(3, $this->textStatisticsService->getNumberOfPalindromeWords());
    }

    public function test_it_can_return_is_text_is_palindrome()
    {
        $this->textStatisticsService->calculate('WOW');
        $this->assertEquals(1, $this->textStatisticsService->getIsPalindrome());
    }

    public function test_it_can_reverse_text()
    {
        $this->textStatisticsService->calculate('WOW WOW');
        $this->assertEquals('WOW WOW', $this->textStatisticsService->getReversedText());

        $this->textStatisticsService->calculate('One two!');
        $this->assertEquals('!owt enO', $this->textStatisticsService->getReversedText());
    }

    public function test_it_can_get_top_longest_words()
    {
        $this->textStatisticsService->calculate('Php - popular scripting language.');
        $this->assertEquals([
            'scripting',
            'language',
            'popular',
            'Php',
        ], $this->textStatisticsService->getTopLongestWords());
    }
}
