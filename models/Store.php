<?php

class Store
{
    const   STORE_APPLE = 'AppleStore',
            STORE_AMAZON = 'Amazon',
            STORE_TEST = 'Test',
            STORE_GOOGLE = 'GooglePlay',
            STORE_WP = 'WP';

    public static $available = [
        self::STORE_APPLE => 'Apple Store',
        self::STORE_GOOGLE => 'Google Play',
        self::STORE_TEST => 'Test',
        self::STORE_AMAZON => 'Amazon',
        self::STORE_WP => 'Windows Phone',
    ];
} 