<?php require __DIR__ . '/../header.php'; ?>

<h1>WeightOfGrades List</h1>
<ul>
    <li>
        <a href="/weight_of_grades/list">list</a>
    </li>
    <li>
        <a href="/weight_of_grades/insert">Insert</a>
    </li>
    <li>
        <a href="/weight_of_grades/update">Update</a>
    </li>
    <li>
        <a href="/weight_of_grades/delete">Delete</a>
    </li>
</ul>
<?php
if( empty($list) ) {
    ?>
    <p>No weight_of_grades found</p>
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
