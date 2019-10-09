<div class="card card-small mb-4">
    <div class="card-header border-bottom">
        <div class="row">
            <div class="col-12">
                <h5 class="card-title float-left">All Words</h5>
                <a href="dictionary.php?source=add_word" class="btn btn-primary float-right">Add New Word</a>
            </div>
        </div>
    </div>
    <div class="card-body pb-3 text-left">
        <table class="table table-striped table-bordered" style="width: 100%;" id="view_all_posts">
            <thead class="bg-light">
                <tr>
                    <th>Title</th>
                    <th>Pronounciation</th>
                    <th>Meaning</th>
                    <th>Explanation</th>
                    <th>Examples</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = "SELECT word_id, word_title, word_pronounce, word_meaning, word_explanation, word_examples FROM dictionary ORDER BY word_title ASC ";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_execute($stmt);
                confirmQuery($stmt);
                mysqli_stmt_store_result($stmt);
                mysqli_stmt_bind_result($stmt, $word_id, $word_title, $word_pronounce, $word_meaning, $word_explanation, $word_examples);
                
                while(mysqli_stmt_fetch($stmt)) {

                    echo "<tr>";

                    echo "<td>$word_title<br>

                    <div class='blog-comments__actions'>
                        <div class='btn-group btn-group-sm'>
                            <button type='button' class='btn btn-white'>
                                <a href='dictionary.php?source=edit_word&edit={$word_id}'>
                                <span class='text-light'>
                                    <i class='material-icons'>edit</i>
                                </span> Edit 
                                </a>
                            </button>
                        </div>
                    </div>
                    </td>";
                    echo "<td>$word_pronounce</td>";
                    echo "<td>$word_meaning</td>";
                    echo "<td>$word_explanation</td>";
                    echo "<td>$word_examples</td>";
                    
                    echo "</tr>";
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Pronounciation</th>
                    <th>Meaning</th>
                    <th>Explanation</th>
                    <th>Examples</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>