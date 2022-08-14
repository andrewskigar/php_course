<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Text statistics</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="p-8">
    <form method="post" action="/stats">
        @csrf
        <textarea class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="text" id="text" cols="90" rows="10" placeholder="Enter text to get it's statistics">@if (! empty($text)) {{ $text }} @endif</textarea>
        <button class="block mt-4 px-4 py-2 font-semibold text-sm bg-white text-slate-700 dark:bg-slate-700 dark:text-white rounded-md shadow-sm ring-1 ring-slate-900/5 dark:ring-white/10 dark:ring-inset border-indigo-500 border-2 border-none" type="submit" value="Calculate">Calculate</button>
    </form>

    @if (! empty($text))
    <div class="mt-8">
        <p class="w-1/2">{{ $textStats->getReversedText() }}</p>
        <table class="mt-4 border-collapse border border-slate-500">
            <tr>
                <td class="p-2 border border-slate-700">Number of characters</td>
                <td class="p-2 border border-slate-700">{{ $textStats->getNumberOfCharacters() }}</td>
            </tr>
            <tr>
                <td class="p-2 border border-slate-700">Number of words</td>
                <td class="p-2 border border-slate-700">{{ $textStats->getNumberOfWords() }}</td>
            </tr>
            <tr>
                <td class="p-2 border border-slate-700">Number of sentences</td>
                <td class="p-2 border border-slate-700">{{ $textStats->getNumberOfSentences() }}</td>
            </tr>
            <tr x-data="{ open: false }">
                <td class="p-2 border border-slate-700 align-top">
                    <span x-on:click="open = ! open" class="border-b border-dashed border-gray-500 cursor-pointer">Frequency of characters</span>
                </td>
                <td class="p-2 border border-slate-700">
                    <ul x-show="open" x-transition style="display: none;">
                        @foreach ($textStats->getFrequencyOfCharacters() as $character => $frequency)
                            <li><span class="inline-block align-right" style="width: 15px;">{{ $character }}</span> <span class="text-gray-400">({{ $frequency }})</span></li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="p-2 border border-slate-700">Average word length</td>
                <td class="p-2 border border-slate-700">{{ $textStats->getAverageWordLength() }}</td>
            </tr>
            <tr>
                <td class="p-2 border border-slate-700">The average number of words in a sentence</td>
                <td class="p-2 border border-slate-700">{{ $textStats->getAverageNumberWordsInSentence() }}</td>
            </tr>
            <tr x-data="{ open: false }">
                <td class="p-2 border border-slate-700 align-top">
                    <span x-on:click="open = ! open" class="border-b border-dashed border-gray-500 cursor-pointer">Top 10 most used words</span>
                </td>
                <td class="p-2 border border-slate-700">
                    <ul x-show="open" x-transition style="display: none;">
                        @foreach ($textStats->getTopUsedWords() as $word)
                            <li>{{ $word }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr x-data="{ open: false }">
                <td class="p-2 border border-slate-700 align-top">
                    <span x-on:click="open = ! open" class="border-b border-dashed border-gray-500 cursor-pointer">Top 10 longest words</span>
                </td>
                <td class="p-2 border border-slate-700">
                    <ul x-show="open" x-transition style="display: none;">
                        @foreach ($textStats->getTopLongestWords() as $word)
                            <li>{{ $word }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr x-data="{ open: false }">
                <td class="p-2 border border-slate-700 align-top">
                    <span x-on:click="open = ! open" class="border-b border-dashed border-gray-500 cursor-pointer">Top 10 shortest words</span>
                </td>
                <td class="p-2 border border-slate-700">
                    <ul x-show="open" x-transition style="display: none;">
                        @foreach ($textStats->getTopShortestWords() as $word)
                            <li>{{ $word }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr x-data="{ open: false }">
                <td class="p-2 border border-slate-700 align-top">
                    <span x-on:click="open = ! open" class="border-b border-dashed border-gray-500 cursor-pointer">Top 10 longest sentences</span>
                </td>
                <td class="p-2 border border-slate-700">
                    <ul x-show="open" x-transition style="display: none;">
                        @foreach ($textStats->getTopLongestSentences() as $sentence)
                            <li>{{ $sentence }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr x-data="{ open: false }">
                <td class="p-2 border border-slate-700 align-top">
                    <span x-on:click="open = ! open" class="border-b border-dashed border-gray-500 cursor-pointer">Top 10 shortest sentences</span>
                </td>
                <td class="p-2 border border-slate-700">
                    <ul x-show="open" x-transition style="display: none;">
                        @foreach ($textStats->getTopShortestSentences() as $sentence)
                            <li>{{ $sentence }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="p-2 border border-slate-700">Number of palindrome words</td>
                <td class="p-2 border border-slate-700">{{ $textStats->getNumberOfPalindromeWords() }}</td>
            </tr>
            <tr x-data="{ open: false }">
                <td class="p-2 border border-slate-700 align-top">
                    <span x-on:click="open = ! open" class="border-b border-dashed border-gray-500 cursor-pointer">Top 10 longest palindrome words</span>
                </td>
                <td class="p-2 border border-slate-700">
                    <ul x-show="open" x-transition style="display: none;">
                        @foreach ($textStats->getTopLongestPalindromeWords() as $word)
                            <li>{{ $word }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="p-2 border border-slate-700">Is the whole text a palindrome?</td>
                <td class="p-2 border border-slate-700">{{ $textStats->getIsPalindrome() ? 'Yes' : 'No' }}</td>
            </tr>
        </table>
        <p class="mt-4 italic">Generated: <span>{{ date('Y-m-d H:i:s') }}</span></p>
        <p class="mt-4 italic">Took: <span>{{ $textStats->tookMs() }} ms</span></p>
    </div>
    @endif
</div>
</body>
</html>
