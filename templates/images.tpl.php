<?php

/**
 *
 * @global array $images
 */

$cards = '';

if ($images) {
    foreach ($images as $image) {
        $cards .= "
            <div class='card'>
                <img src='{$image['image_url']}' alt='{$image['temperament']}'></a>
                <p>{$image['id']}</p>
            </div>
        ";
    }
}

return <<<HTML

<style>
    * {
        padding: 0;
        margin: 0;
    }
    .container {
        width: 100%;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .card {
        box-sizing: border-box;
        margin: 10px;
        width: 250px;
        height: 250px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        border: 1px #ebebeb solid;
        border-radius: 10px;
    }
    .card img {
        object-fit: cover;
        width: 200px;
        height: 200px;
    }
    .card p {
        color: #333;
        font-size: 16px;
        font-family: Verdana, sans-serif;
        font-weight: bolder;
        padding-top: 10px;
    }
    .card a {
        color: #333;
        text-decoration: none;
    }
    .card a:hover {
        color: #656565;
        text-decoration: none;
    }
</style>

<div class="container">
    $cards
</div>

<div style="text-align: center; margin-top: 30px; font-size: 32px;">
    &larr; <a href="/breeds">Breeds</a>
</div>
HTML;
