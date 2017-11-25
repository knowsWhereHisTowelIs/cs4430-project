<?php require __DIR__ . '/../header.php'; ?>

<h1>Students List</h1>
<ul>
    <li>
        <a href="/students/list">list</a>
    </li>
    <li>
        <a href="/students/insert">Insert</a>
    </li>
    <li>
        <a href="/students/update">Update</a>
    </li>
    <li>
        <a href="/students/delete">Delete</a>
    </li>
</ul>
<?php
if( empty($list) ) {
    ?>
    <p>No students found</p>
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
    echo "<table>";
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
