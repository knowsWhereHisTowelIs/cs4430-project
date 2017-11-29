<?php require __DIR__ . '/../header.php'; ?>

<?php formatted_var_dump (get_defined_vars());?>

<h1>Classes List</h1>
<form method='post'>
    <div>
        <label>
            TID
            <input name='tid' value='<?php echo $tid;?>' />
        </label>
    </div>

    <div>
        <label>
            CNAME
            <input name='cname' value='<?php echo $cname;?>' />
        </label>
    </div>
    <div>
        <label>
            SUBJECT
            <input name='subject' value='<?php echo $subject;?>' />
        </label>
    </div>
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
