<?php
session_start();

if (!isset($_SESSION['username'])) {
    $this->view("server/login");
    exit();
}
?>
<?php include "../app/views/partials/adminheader.php" ?>
<body style="background-color: gray;">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#createArticleModal">Add New Article</button>
    </div>

    <table class="table table-striped mt-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border-radius: 5px; overflow: hidden;">
        <h2>Articles List</h2>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        <?php if (empty($articles)) { ?>
            <tr>
                <td colspan="6" class="text-center">No articles found! Please add an article!</td>
            </tr>
        <?php } else { ?>
            <?php foreach ($articles as $article) { ?>
                <tr>
                    <td><?= htmlspecialchars($article->title) ?></td>
                    <td><?= htmlspecialchars(substr($article->content, 0, 50)) ?></td>
                    <td><?= htmlspecialchars($article->created_at) ?></td>
                    <td><?= htmlspecialchars($article->updated_at) ?></td>
                    <td><?= htmlspecialchars($article->category_id) ?></td>
                    <td>
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#editArticleModal<?= $article->id ?>">Edit</button>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteArticleModal<?= $article->id ?>">Delete</button>
                    </td>
                </tr>

                <!-- Edit Article Modal -->
                <div class="modal fade" id="editArticleModal<?= $article->id ?>" tabindex="-1" role="dialog" aria-labelledby="editArticleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editArticleModalLabel">Edit Article</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= SERVER ?>/edit-article/<?= $article->id ?>" method="POST">
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label for="">Title</label>
                                        <input type="text" name="title" value="<?= htmlspecialchars($article->title) ?>" class="form-control" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Content</label>
                                        <textarea name="content" class="form-control" required><?= htmlspecialchars($article->content) ?></textarea>
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Category ID</label>
                                        <input type="number" name="category_id" value="<?= htmlspecialchars($article->category_id) ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Article Modal -->
                <div class="modal fade" id="deleteArticleModal<?= $article->id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteArticleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteArticleModalLabel">Delete Article</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= SERVER ?>/delete-article/<?= $article->id ?>" method="POST">
                                <div class="modal-body text-center">
                                    <p>Are you sure you want to delete this article?</p>
                                    <p><strong>Title:</strong> <?= htmlspecialchars($article->title) ?></p>
                                    <input type="hidden" name="id" value="<?= $article->id ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </table>
</div>

<!-- Modal for Creating an Article -->
<div class="modal fade" id="createArticleModal" tabindex="-1" role="dialog" aria-labelledby="createArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createArticleModalLabel">Create Article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= SERVER ?>/create-article" method="POST">
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="">Content</label>
                        <textarea name="content" class="form-control" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="">Category ID</label>
                        <input type="number" name="category_id" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
<?php include "../app/views/partials/footer.php" ?>