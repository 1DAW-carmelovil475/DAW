<?php



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__.'/src/functions.php');

session_start();

$board = getBoardFromCSV(__DIR__.'/src/board_data/board1.csv');

$num_rows = count($board);
$num_columns = count($board[0]);


if (!isset($_SESSION['link_pos'])) {
    $_SESSION['link_pos'] = ['top' => 1, 'left' => 1];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $direction = $_POST['direction'] ?? '';
    $_SESSION['link_pos'] = moveLink($_SESSION['link_pos'], $direction, $num_rows, $num_columns);

    header('Location: ./');
    exit;
}

$link_pos = $_SESSION['link_pos'];

$board_markup = getBoardMarkup($board);

include(__DIR__.'/templates/index.tpl.php');

?>