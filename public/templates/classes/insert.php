<?php require __DIR__ . '/../header.php'; ?>

<h1>Classes List</h1>

<form method='post'>
    <div>
        <label>
            TID
            <input name='tid' value='' />
        </label>
    </div>

    <div>
        <label>
            CNAME
            <input name='cname' value='' />
        </label>
    </div>
    <div>
        <label>
            SUBJECT
            <input name='subject' value='' />
        </label>
    </div>
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
