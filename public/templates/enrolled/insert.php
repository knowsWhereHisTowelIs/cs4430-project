<?php require __DIR__ . '/../header.php'; ?>

<h1>Enrolled List</h1>

<form method='post'>

    <div>
        <label>
            SID
            <input name='sid' value='' />
        </label>
    </div> 
    <div>
        <label>
            CID
            <input name='cid' value='' />
        </label>
    </div>
    
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
