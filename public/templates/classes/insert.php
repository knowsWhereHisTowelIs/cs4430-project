<?php require __DIR__ . '/../header.php'; ?>

<h1>Class Insert</h1>

<form method='post'>
    <div>
        <label>
            Teacher ID (tid)
            <input name='tid' value='' />
        </label>
    </div>

    <div>
        <label>
            Class Name (cname)
            <input name='cname' value='' />
        </label>
    </div>
    <div>
        <label>
            Subject
            <input name='subject' value='' />
        </label>
    </div>
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
