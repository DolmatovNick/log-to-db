<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Logs</title>
    <meta name="description" content="Logs">

</head>

<h1>Logs</h1>

<table>
    <tr>
        <td>Ip</td>
        <td>Browser</td>
        <td>Os</td>
        <td>First url</td>
        <td>Last url</td>
        <td>Count unique</td>
    </tr>
    <?php
        /**  @var $this Template */
        foreach ($this->data['rows'] as $row) { ?>
        <tr>
            <td><?=htmlspecialchars($row['ip']);?></td>
            <td><?=htmlspecialchars($row['browser']);?></td>
            <td><?=htmlspecialchars($row['os']);?></td>
            <td><?=htmlspecialchars($row['first_url']);?></td>
            <td><?=htmlspecialchars($row['last_url']);?></td>
            <td><?=htmlspecialchars($row['unique_count']);?></td>
        </tr>
    <?php } ?>
</table>

<?php include 'paginator.tpl '?>

<body>
</body>
</html>
