<?php if (isset($_SESSION['errors'])): foreach ($_SESSION['errors'] as $error): ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endforeach; endif; ?>
<form method="post"
      action="<?= isset($exercise['id']) ? '/exercises/update-exercise?id=' . $exercise['id'] : '/exercises/add-exercise' ?>">
    <div class="form-group">
        <label for="exampleInputUserName">User Name</label>
        <input name="user_name" value="<?= isset($exercise['user_name']) ? $exercise['user_name'] : '' ?>" required
               type="text" class="form-control" id="exampleInputUserName" aria-describedby="emailHelp"
               placeholder="Enter user name"></div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input name="email" value="<?= isset($exercise['email']) ? $exercise['email'] : '' ?>" required type="email"
               class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Text</label>
        <textarea name="text" required class="form-control" id="exampleFormControlTextarea1"
                  rows="3"><?= isset($exercise['text']) ? $exercise['text'] : '' ?></textarea>
    </div>
    <?php if ($isAdmin) : ?>
        <div class="form-check">
            <input <?= isset($exercise['user_name']) ? 'checked' : '' ?> name="is_finish" type="checkbox"
                                                                         class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Is finished</label>
        </div>
        <br>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>