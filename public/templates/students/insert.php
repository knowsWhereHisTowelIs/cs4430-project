<?php require __DIR__ . '/../header.php'; ?>

<h1>Students List</h1>
<form method='post'>
    <div>
        <label>
            SNAME
            <input name='sname' value='' />
        </label>
    </div>

    <div>
        <label>
            STATUS
            <input name='status' value='' />
        </label>
    </div>
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
