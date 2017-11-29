<?php require __DIR__ . '/../header.php'; ?>

<h1>Teachers List</h1>
<form method='post'>
    <div>
        <label>
            TNAME
            <input name='tname' value='' />
        </label>
    </div>

    <div>
        <label>
            POSITION
            <input name='position' value='' />
        </label>
    </div>
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
