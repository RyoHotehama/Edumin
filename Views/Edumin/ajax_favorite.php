<?php
session_start();
require_once(ROOT_PATH .'/Models/Favorites.php');

$request = new Favorites();
if (isset($_POST['submission_id'])) {
    $submission_id = $_POST['submission_id'];
    $user_id = $_SESSION['login']['id'];

    $result = $request -> checkFavorite($user_id, $submission_id);

    if (!empty($result)) {
        $request -> deleteFavorite($user_id, $submission_id);
    } else {
        $request -> insertFavorite($user_id, $submission_id);
    }
}
