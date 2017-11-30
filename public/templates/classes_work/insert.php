<?php require __DIR__ . '/../header.php'; ?>

<h1>ClassesWork List</h1>

<form method='post'>
    <div>
        <label>
            Classes ID (cid)
            <input name='cid' value='' />
        </label>
    </div>

    <div>
        <label>
            Assignment ID (aid)
            <input name='aid' value='' />
        </label>
    </div>

    <div>
        <label>
            Student ID (sid)
            <input name='sid' value='' />
        </label>
    </div>

    <div>
        <label>
            Grade
            <input name='grade' value='' />
        </label>
    </div>
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
