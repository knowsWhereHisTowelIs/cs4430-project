<?php require __DIR__ . '/../header.php'; ?>

<h1>Teachers List</h1>
<form method='post'>
    <p>Are you sure you want to delete?</p>
    <input type="hidden" name="tid" value="<?php echo $tid; ?>" />
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
