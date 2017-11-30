 <?php require __DIR__ . '/../header.php'; ?>

<h1>Assignment Grade</h1>

<form method='post'>
    <div>
        <label>
            Class ID (cid)
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
    <input name='submitted' type='submit' />
</form>

<?php
if( isset($grade) ) {
    echo "<p>Your grade is:$grade</p>";
}
?>

<?php require __DIR__ . '/../footer.php'; ?>
