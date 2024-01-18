<?php

$config = require('config.php');
$db = new Database($config['database']);

$heading = 'Note';

$note = $db->query('select * from notes where user_id = :user_id and id = :id', [
    'user_id'  => 2,
    'id' => $_GET['id']
])->fetch();

$currentUserId = 1;

if ($note['user_id'] !== $currentUserId) {
    abort(Response::FORBIDDEN);
}

if (!$note) {
    abort();
}

require "views/note.view.php";
