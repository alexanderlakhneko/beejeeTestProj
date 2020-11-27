<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['error'];
        unset($_SESSION['error']) ?>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert alert-success" role="alert">
        <?= $_SESSION['flash'];
        unset($_SESSION['flash']) ?>
    </div>
<?php endif; ?>
<a href="/exercises/add">
    <button type="button" class="btn btn-primary">Add</button>
</a>
<table id="adminTable">
    <thead>
    <tr>
        <th>User name</th>
        <th>Email</th>
        <th>Text</th>
        <th>Is Finished</th>
        <th>Is Edited by Admin</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
