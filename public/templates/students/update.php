<?php require __DIR__ . '/../header.php'; ?>

<?php formatted_var_dump (get_defined_vars());?>

<h1>Students List</h1>
<form method='post'>
    <div>
        <label>
            SNAME
            <input name='sname' value='<?php echo $sname;?>' />
        </label>
    </div>

    <div>
        <label>
            STATUS
            <input name='status' value='<?php echo $status;?>' />
        </label>
    </div>
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
