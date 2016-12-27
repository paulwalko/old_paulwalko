<?php

	// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=robotics-hours.csv');

	// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

	// output the column headings
fputcsv($output, array('id', 'pin', 'hours', 'date'));

	// fetch the data
mysql_connect('localhost', 'root', 'paul');
mysql_select_db('robo');
$rows = mysql_query('SELECT id, pin, hours, date FROM log');

	// loop over the rows, outputting them
while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
?>
