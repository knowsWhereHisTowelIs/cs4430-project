<?php require __DIR__ . '/../header.php'; ?>

<h1>Enrolled List</h1>
<ul>
    <li>
        <a href="/enrolled/list">list</a>
    </li>
    <li>
        <a href="/enrolled/insert">Insert</a>
    </li>
    <li>
        <a href="/enrolled/update">Update</a>
    </li>
    <li>
        <a href="/enrolled/delete">Delete</a>
    </li>
</ul>
<?php
if( empty($list) ) {
    ?>
    <p>No enrolled found</p>
    <?php
} else {
    $keys = array_keys($list[0]);
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    foreach($keys as $k) {
        echo "<th>$k</th>";
    }
    echo "</tr>";
    echo "<tbody>";
    foreach($list as $row) {
        echo "<tr>";
        foreach($row as $v) {
            echo "<td>$v</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
?>

<?php require __DIR__ . '/../footer.php'; ?>
