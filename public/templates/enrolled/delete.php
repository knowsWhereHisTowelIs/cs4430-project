<?php require __DIR__ . '/../header.php'; ?>

<h1>Enrolled List</h1>
<form method='post'>
    <p>Are you sure you want to delete?</p>
    <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
    <input type="hidden" name="cid" value="<?php echo $cid; ?>" />
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
