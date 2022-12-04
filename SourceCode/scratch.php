<?php

session_start();

function display_data($array): string
{
    // start table
    $html = "";
    // header row
    $html .= '<tr>';
    foreach ($array[0] as $key => $value) {
        if ($key == null) {
            $key = "Index";
        }
        $html .= '<th>' . htmlspecialchars($key) . '</th>';
    }
    $html .= '</tr>';

    // data rows
    /** @noinspection PhpUnusedLocalVariableInspection */
    foreach ($array as $key => $value) {
        $html .= '<tr>';
        /** @noinspection PhpUnusedLocalVariableInspection */
        foreach ($value as $key2 => $value2) {
            if ($value2 == null) {
                $value2 = "null";
            }
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }
        $html .= '</tr>';
    }

    return $html;
}

if (isset($_SESSION['table']) && $_SESSION['table'] != "") {
    $connection = mysqli_connect('localhost', 'root', '', 'airasiadb');

    $query = "SELECT * FROM cards";
    $result = mysqli_query($connection, $query);

    echo display_data(mysqli_fetch_all($result));
    mysqli_close($connection); //Make sure to close out the database connection
}