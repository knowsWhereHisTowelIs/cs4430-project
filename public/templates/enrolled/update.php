<?php require __DIR__ . '/../header.php'; ?>

<?php formatted_var_dump (get_defined_vars());?>

<h1>Enrolled List</h1>
<form method='post'>

    <div>
        <label>
            SID
            <input name='sid' value='<?php echo $sid;?>' />
        </label>
    </div>
    
    <div>
        <label>
            CID
            <input name='aid' value='<?php echo $cid;?>' />
        </label>
    </div>
    
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
