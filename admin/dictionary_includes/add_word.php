<?php

if (isset($_POST['create'])) {
    $word_title         = $_POST['word_title'];
    $word_pronounce     = $_POST['word_pronounce'];
    $word_tags          = $_POST['word_tags'];
    $word_meaning       = $_POST['word_meaning'];
    $word_meaning       = str_ireplace("\r\n", '', $word_meaning);
    $word_explanation   = $_POST['word_explanation'];
    $word_explanation   = str_ireplace("\r\n", '', $word_explanation);
    $word_examples      = $_POST['word_examples'];
    $word_examples      = str_ireplace("\r\n", '', $word_examples);

    $query = "INSERT INTO dictionary (word_title, word_pronounce, word_meaning, word_tags, word_explanation, word_examples) VALUES (?, ?, ?, ?, ?, ?) ";
    $save_stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($save_stmt, 'ssssss', $word_title, $word_pronounce, $word_meaning, $word_tags, $word_explanation, $word_examples);
    mysqli_stmt_execute($save_stmt);
    confirmQuery($save_stmt);

    // echo "<meta http-equiv='refresh' content='0'>";
}

?>

<div class="card mb-5">
    <div class="card-body">
        <h5 class="card-title">Add New Word</h5>
        <hr>
        <form method="POST" action="">
            <div class="row">
                <div class="col form-group">
                    <label>Word Title</label>
                    <input type="text" name="word_title" class="form-control" required>
                </div>
                <div class="col form-group">
                    <label>Word Pronounciation</label>
                    <input type="text" name="word_pronounce" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col form-group">
                    <label>Meaning</label>
                    <input type="text" name="word_meaning" class="form-control" required>
                </div>
                <div class="col form-group">
                    <label>Word Tags</label>
                    <input type="text" name="word_tags" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label>Explanation</label>
                <textarea id="wordEditor1" name="word_explanation" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>More Examples</label>
                <textarea id="wordEditor2" name="word_examples" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="create" class="btn btn-lg btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>