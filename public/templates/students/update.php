<?php require __DIR__ . '/../header.php'; ?>

<?php // formatted_var_dump (get_defined_vars());?>

<h1>Students List</h1>
<form method='post'>
    <div>
        <label>SNAME</label>
        <input name='sname' value='<?php echo $sname;?>' />
    </div>

    <div>
        <label>STATUS</label>
        <input name='status' value='<?php echo $status;?>' />
    </div>
    <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
