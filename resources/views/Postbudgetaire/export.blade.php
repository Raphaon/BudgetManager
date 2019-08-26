<?php
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Users.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('No', 'First Name', 'Last Name', 'Email'));

if (count($users) > 0) {
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
}
?>
