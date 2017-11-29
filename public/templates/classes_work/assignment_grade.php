 <?php require __DIR__ . '/../header.php'; ?>

<h1>Assignment Grade</h1>

<form method='post'>
    <div>
        <label>
            CID
            <input name='cid' value='' />
        </label>
    </div>

    <div>
        <label>
            AID
            <input name='aid' value='' />
        </label>
    </div>
    <div>
        <label>
            SID
            <input name='sid' value='' />
        </label>
    </div>
    <input name='submitted' type='submit' />
</form>

<?php echo $grade; ?>
<?php require __DIR__ . '/../footer.php'; ?>
