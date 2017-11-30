<?php require __DIR__ . '/../header.php'; ?>

<?php // formatted_var_dump (get_defined_vars());?>

<h1>Teachers List</h1>
<form method='post'>
    <div>
        <label>TNAME</label>
        <input name='tname' value='<?php echo $tname;?>' />
    </div>

    <div>
        <label>POSITION</label>
        <input name='position' value='<?php echo $position;?>' />
    </div>
    <input type="hidden" name="tid" value="<?php echo $tid; ?>" />
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
