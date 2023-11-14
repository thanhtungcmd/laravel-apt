<?php

Route::get('/', function () {
    dd(config());
    return env("DREAMPALADIN_TEST_01");
});
