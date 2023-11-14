<?php

Route::get('/', function () {
    dd(config());
    return env("TEST_01");
});
