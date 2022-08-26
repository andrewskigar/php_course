<?php

namespace App\Clients;

use App\Contracts\CatClientInterface;
use GuzzleHttp\ClientInterface;

class StubbedCatClient implements CatClientInterface
{

    public function breeds(): array
    {
        return [
            [
                'id' => 'abys',
                'name' => 'Abyssinian',
                'description' => "The Abyssinian is easy to care for, and a joy to have in your home. They’re affectionate cats and love both people and other animals.",
                'temperament' => 'Active, Energetic, Independent, Intelligent, Gentle',
                'image_url' => 'https://cdn2.thecatapi.com/images/0XYvRd7oD.jpg'
            ],
            [
                'id' => 'asho',
                'name' => 'American Shorthaired',
                'description' => 'The American Shorthaired is known for its longevity, robust health, good looks, sweet personality, and amiability with children, dogs, and other pets.',
                'temperament' => 'Active, Curious, Easy Going, Playful, Calm',
                'image_url' => 'https://cdn2.thecatapi.com/images/JFPROfGtQ.jpg'
            ],
            [
                'id' => 'awir',
                'name' => 'American Wirehair',
                'description' => 'The American Wirehair tends to be a calm and tolerant cat who takes life as it comes. His favorite hobby is bird-watching from a sunny windowsill, and his hunting ability will stand you in good stead if insects enter the house.',
                'temperament' => 'Affectionate, Curious, Gentle, Intelligent, Interactive, Lively, Loyal, Playful, Sensible, Social',
                'image_url' => 'https://cdn2.thecatapi.com/images/8D--jCd21.jpg'
            ],
            [
                'id' => 'amis',
                'name' => 'Australian Mist',
                'description' => 'The Australian Mist thrives on human companionship. Tolerant of even the youngest of children, these friendly felines enjoy playing games and being part of the hustle and bustle of a busy household. They make entertaining companions for people of all ages, and are happy to remain indoors between dusk and dawn or to be wholly indoor pets.',
                'temperament' => 'Lively, Social, Fun-loving, Relaxed, Affectionate',
                'image_url' => 'https://cdn2.thecatapi.com/images/_6x-3TiCA.jpg'
            ],
            [
                'id' => 'beng',
                'name' => 'Bengal',
                'description' => "Bengals are a lot of fun to live with, but they're definitely not the cat for everyone, or for first-time cat owners. Extremely intelligent, curious and active, they demand a lot of interaction and woe betide the owner who doesn't provide it.",
                'temperament' => 'Alert, Agile, Energetic, Demanding, Intelligent',
                'image_url' => 'https://cdn2.thecatapi.com/images/O3btzLlsO.png'
            ],
        ];
    }

    public function images(string $breedId, string $size = 'thumb'): array
    {
        return [
            [
                'id' => 'tOGSsMx5J',
                'description' => 'The Scottish Fold is a sweet, charming breed. She is an easy cat to live with and to care for. She is affectionate and is comfortable with all members of her family. Her tail should be handled gently. Folds are known for sleeping on their backs, and for sitting with their legs stretched out and their paws on their belly. This is called the "Buddha Position".',
                'temperament' => 'Affectionate, Intelligent, Loyal, Playful, Social, Sweet, Loving',
                'image_url' => 'https://cdn2.thecatapi.com/images/tOGSsMx5J.jpg'
            ],
            [
                'id' => 'q7izjTTa4',
                'description' => 'The Scottish Fold is a sweet, charming breed. She is an easy cat to live with and to care for. She is affectionate and is comfortable with all members of her family. Her tail should be handled gently. Folds are known for sleeping on their backs, and for sitting with their legs stretched out and their paws on their belly. This is called the "Buddha Position".',
                'temperament' => 'Affectionate, Intelligent, Loyal, Playful, Social, Sweet, Loving',
                'image_url' => 'https://cdn2.thecatapi.com/images/q7izjTTa4.jpg'
            ],
            [
                'id' => 'IOqJ6RK7L',
                'description' => 'The Scottish Fold is a sweet, charming breed. She is an easy cat to live with and to care for. She is affectionate and is comfortable with all members of her family. Her tail should be handled gently. Folds are known for sleeping on their backs, and for sitting with their legs stretched out and their paws on their belly. This is called the "Buddha Position".',
                'temperament' => 'Affectionate, Intelligent, Loyal, Playful, Social, Sweet, Loving',
                'image_url' => 'https://cdn2.thecatapi.com/images/IOqJ6RK7L.jpg'
            ],
            [
                'id' => 'MVQu5GSK1',
                'description' => 'The Scottish Fold is a sweet, charming breed. She is an easy cat to live with and to care for. She is affectionate and is comfortable with all members of her family. Her tail should be handled gently. Folds are known for sleeping on their backs, and for sitting with their legs stretched out and their paws on their belly. This is called the "Buddha Position".',
                'temperament' => 'Affectionate, Intelligent, Loyal, Playful, Social, Sweet, Loving',
                'image_url' => 'https://cdn2.thecatapi.com/images/MVQu5GSK1.jpg'
            ],
            [
                'id' => 'TOozwr2OD',
                'description' => 'The Scottish Fold is a sweet, charming breed. She is an easy cat to live with and to care for. She is affectionate and is comfortable with all members of her family. Her tail should be handled gently. Folds are known for sleeping on their backs, and for sitting with their legs stretched out and their paws on their belly. This is called the "Buddha Position".',
                'temperament' => 'Affectionate, Intelligent, Loyal, Playful, Social, Sweet, Loving',
                'image_url' => 'https://cdn2.thecatapi.com/images/TOozwr2OD.jpg'
            ],
        ];
    }
}
