<?php

function updateUser(String $testString): bool
{
    $regexFilter = "/[^A-Za-z0-9]/";
    return !preg_match($regexFilter, $testString);
}

//TODO Incorporate this in input fields