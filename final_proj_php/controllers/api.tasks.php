<?php

$boards = App::get('database')->getAll('boards');
var_dump($boards);
//echo json_encode($tasks);