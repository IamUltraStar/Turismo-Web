<?php

function view(string $path = "")
{
    return header('Location: ' . base_url($path));
}