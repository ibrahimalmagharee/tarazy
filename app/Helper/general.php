<?php

function uploadImage($folder, $image)
{
    $image -> store('/', $folder);
    $filename = $image -> hashName();

    return $filename;
}
