<?php require __DIR__ . '/../header.php'; ?>

<h1>WeightOfGrades Insert</h1>

<form method='post'>

    <div>
        <label>
            CID
            <input name='cid' value='' />
        </label>
    </div>
    
    
    <div>
        <label>
            ANAME
            <input name='aname' value='' />
        </label>
    </div> 
    
    <div>
        <label>
            WEIGHT
            <input name='weight' value='' />
        </label>
    </div> 
    
    <input name='submitted' type='submit' />
</form>

<?php require __DIR__ . '/../footer.php'; ?>
