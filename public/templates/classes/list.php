<?php require __DIR__ . '/../header.php'; ?>

<h1>Classes List</h1>
<ul>
    <li>
        <a href="/classes/insert">Insert</a>
    </li>
</ul>
<?php
if( empty($list) ) {
    ?>
    <p>No classes found</p>
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

            <form method='post' action='/classes/students_in_class'>
                <input type='hidden' name='cid' value="<?=$row['cid']?>" />
                <button type='submit'>Student List</button>
            </form>
            <form method='post' action='/classes/update'>
                <input type='hidden' name='cid' value="<?=$row['cid']?>" />
                <button type='submit'>Update</button>
            </form>
            <form method='post' action='/classes/delete'>
                <input type='hidden' name='cid' value="<?=$row['cid']?>" />
                <button type='submit'>delete</button>
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
