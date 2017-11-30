<?php require __DIR__ . '/../header.php'; ?>

<h1>Update Class</h1>
<form method='post'>
    <div>
        <label>
            Teacher ID (tid)
            <input name='tid' value='<?php echo $tid;?>' />
        </label>
    </div>

    <div>
        <label>
            Class Name (class)
            <input name='cname' value='<?php echo $cname;?>' />
        </label>
    </div>
    <div>
        <label>
            Subject
            <input name='subject' value='<?php echo $subject;?>' />
        </label>
    </div>
    <input type="hidden" name="cid" value="<?php echo $cid; ?>" />
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
