<?php

if (isset($_GET['edit'])) {
    $the_word_id = $_GET['edit'];
}
$query = "SELECT * FROM dictionary WHERE word_id = ? ";
$select_stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($select_stmt, 's', $the_word_id);
mysqli_stmt_execute($select_stmt);
confirmQuery($select_stmt);
mysqli_stmt_store_result($select_stmt);
mysqli_stmt_bind_result($select_stmt, $word_id, $word_title, $word_pronounce, $word_meaning, $word_explanation, $word_examples);
mysqli_stmt_fetch($select_stmt);

if (isset($_POST['update'])) {
    $word_title         = $_POST['word_title'];
    $word_pronounce     = $_POST['word_pronounce'];
    $word_meaning       = $_POST['word_meaning'];
    $word_explanation   = $_POST['word_explanation'];
    $word_examples      = $_POST['word_examples'];

    $query = "UPDATE dictionary SET word_title = ?, word_pronounce = ?, word_meaning = ?, word_explanation = ?, word_examples = ? WHERE word_id = ? ";
    $update_stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($update_stmt, 'ssssss', $word_title, $word_pronounce, $word_meaning, $word_explanation, $word_examples, $the_word_id);
    mysqli_stmt_execute($update_stmt);
    confirmQuery($update_stmt);
}

?>

<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="row">
                <div class="col form-group">
                    <label for="Title">Word Title</label>
                    <input type="text" name="word_title" class="form-control" value="<?php echo $word_title; ?>" required>
                </div>
                <div class="col form-group">
                    <label for="Title">Word Pronounciation</label>
                    <input type="text" name="word_pronounce" class="form-control" value="<?php echo $word_pronounce; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="Title">Meaning</label>
                <input type="text" name="word_meaning" class="form-control" value="<?php echo $word_meaning; ?>" required>
            </div>
            <div class="form-group">
                <label for="Title">Explanation</label>
                <textarea id="wordEditor1" name="word_explanation" class="form-control"><?php echo $word_explanation; ?></textarea>
            </div>
            <div class="form-group">
                <label for="Title">More Examples</label>
                <textarea id="wordEditor2" name="word_examples" class="form-control"><?php echo $word_examples; ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update" name="update">
            </div>
        </form>
    </div>
</div>