<?php require __DIR__ . '/../header.php'; ?>

<?php formatted_var_dump (get_defined_vars());?>

<h1>Teachers List</h1>
<form method='post'>
    <div>
        <label>
            SNAME
            <input name='tname' value='<?php echo $tname;?>' />
        </label>
    </div>

    <div>
        <label>
            STATUS
            <input name='position' value='<?php echo $position;?>' />
        </label>
    </div>
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
