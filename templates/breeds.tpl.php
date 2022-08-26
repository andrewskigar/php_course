<?php

/**
 *
 * @global array $breeds
 */

$cards = '';

if ($breeds) {
    foreach ($breeds as $breed) {
        $cards .= "
            <div class='card'>
                <a href='/images/{$breed['id']}'><img src='{$breed['image_url']}' alt='{$breed['description']}'></a>
                <p><a href='/images/{$breed['id']}'>{$breed['name']}</a></p>
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

HTML;
