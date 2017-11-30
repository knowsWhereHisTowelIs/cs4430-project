 <?php require __DIR__ . '/../header.php'; ?>

<h1>Students in Class</h1>

<form method='post'>
    <div>
        <label>
            Class ID (cid)
            <input name='cid' value='' />
        </label>
    </div>
    <input name='submitted' type='submit' />
</form>

<?php echo $sname;?>
<?php require __DIR__ . '/../footer.php'; ?>
