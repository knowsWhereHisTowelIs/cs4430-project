<?php require __DIR__ . '/../header.php'; ?>

<?php //formatted_var_dump (get_defined_vars());?>

<h1>Weight Of Grades List</h1>
<form method='post'>
    <div>
        <label>
            CID
            <input name='cid' value='<?php echo $cid;?>' />
        </label>
    </div>
    <div>
        <label>
            Aname
            <input name='aname' value='<?php echo $aname;?>' />
        </label>
    </div>
    <div>
        <label>
            weight
            <input name='weight' value='<?php echo $weight;?>' />
        </label>
    </div>
                <input type='hidden' name='aid' value="<?=$aid?>" />
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
