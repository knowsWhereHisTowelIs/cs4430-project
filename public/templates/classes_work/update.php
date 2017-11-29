<?php require __DIR__ . '/../header.php'; ?>

<?php formatted_var_dump (get_defined_vars());?>

<h1>ClassesWork List</h1>
<form method='post'>
    <div>
        <label>
            CID
            <input name='cid' value='<?php echo $cid;?>' />
        </label>
    </div>
    
    <div>
        <label>
            ANAME
            <input name='aid' value='<?php echo $aid;?>' />
        </label>
    </div>
    
    <div>
        <label>
            SID
            <input name='sid' value='<?php echo $sid;?>' />
        </label>
    </div>
    
    <div>
        <label>
            GRADE
            <input name='grade' value='<?php echo $grade;?>' />
        </label>
    </div>
    
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
