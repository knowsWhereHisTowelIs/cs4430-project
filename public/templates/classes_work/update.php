<?php require __DIR__ . '/../header.php'; ?>

<?php //formatted_var_dump (get_defined_vars());?>

<h1>ClassesWork List</h1>
<form method='post'>
    <div>
        <label>
            Grade
            <input name='grade' value='<?php echo $grade;?>' />
        </label>
    </div>
                <input type='hidden' name='cid' value="<?=$cid?>" />
                <input type='hidden' name='aid' value="<?=$aid?>" />
                <input type='hidden' name='sid' value="<?=$sid?>" />
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
