<?php require __DIR__ . '/../header.php'; ?>

<h1>ClassesWork List</h1>
<ul>
    <li>
        <a href="/weight_of_grades/insert">Insert</a>
    </li>
</ul>
<?php
if( empty($list) ) {
    ?>
    <p>No Weight of Grades Found</p>
    <?php
} else {
    $keys = array_keys($list[0]);
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    foreach($keys as $k) {
        echo "<th>$k</th>";
    }
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "<tbody>";
    foreach($list as $row) {
        echo "<tr>";
        foreach($row as $v) {
            echo "<td>$v</td>";
        }
        ?>
        <td>
            <form method='post' action='/weight_of_grades/update'>
                <input type='hidden' name='aid' value="<?=$row['aid']?>" />
                <button type='submit'>Update</button>
            </form>
            <form method='post' action='/weight_of_grades/delete'>
                <input type='hidden' name='aid' value="<?=$row['aid']?>" />
                <button type='submit'>Delete</button>
            </form>
        </td>
        <?php
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
?>

<?php require __DIR__ . '/../footer.php'; ?>
