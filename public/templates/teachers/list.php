<?php require __DIR__ . '/../header.php'; ?>

<h1>Teachers List</h1>
<ul>
    <li>
        <a href="/teachers/insert">Insert</a>
    </li>
</ul>
<?php
if( empty($list) ) {
    ?>
    <p>No teachers found</p>
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
            <form method='post' action='/teachers/update'>
                <input type='hidden' name='tid' value="<?=$row['tid']?>" />
                <button type='submit'>Update</button>
            </form>
            <form method='post' action='/teachers/delete'>
                <input type='hidden' name='tid' value="<?=$row['tid']?>" />
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
