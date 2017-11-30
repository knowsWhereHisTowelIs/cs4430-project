<?php require __DIR__ . '/../header.php'; ?>

<?php formatted_var_dump (get_defined_vars());?>

<h1>Enrolled List</h1>
<form method='post'>

    <div>
        <label>
            AID
            <input name='aid' value='<?php echo $aid;?>' />
        </label>
    </div>
    
    <div>
        <label>
            CID
            <input name='cid' value='<?php echo $cid;?>' />
        </label>
    </div>
    
    <div>
        <label>
            ANAME
            <input name='aname' value='<?php echo $aname;?>' />
        </label>
    </div>
    
    <div>
        <label>
            ANAME
            <input name='weight' value='<?php echo $weight;?>' />
        </label>
    </div>
    
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
