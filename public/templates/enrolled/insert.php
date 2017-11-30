<?php require __DIR__ . '/../header.php'; ?>

<h1>Insert Enrolled</h1>

<form method='post'>

    <div>
        <label>
            Student ID (sid)
            <input name='sid' value='' />
        </label>
    </div>
    <div>
        <label>
            Class ID (cid)
            <input name='cid' value='' />
        </label>
    </div>

    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
