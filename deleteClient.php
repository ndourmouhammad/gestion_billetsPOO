<?php

require_once('config.php');

$id = $_GET['id'];
$client->delete($id);
