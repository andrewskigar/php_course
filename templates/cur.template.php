<?php

/**
 *
 * @global string $currency
 */
$price = match($currency) {
    'bitcoin' => 15000,
    'eth' => 1499,
};

$symbol = match($currency) {
    'bitcoin' => '฿',
    'eth' => 'Ξ',
};

return <<<HTML

<style>
    * {
        padding: 0;
        margin: 0;
    }
    .container {
        width: 100vw; 
        height: 100vh;
        display: flex; 
        justify-content: center; 
        align-items: center;
    }
    .card {
        width: 60%; 
        max-width: 500px; 
        height: 60%; 
        max-height: 500px; 
        display: flex; 
        justify-content: center; 
        align-items: center;
        border: 1px #ebebeb solid;
        border-radius: 10px;
    }
    .card p {
        color: #666;
        font-size: 64px;
        font-family: Verdana, sans-serif;
    }
    .card p sup {
        font-size: 40%;
        position: relative;
        top: -16px;
    }
</style>

<div class="container">
    <div class="card">
        <p>$price<sup>$ per $symbol</sup></p>
    </div>
</div>

HTML;
