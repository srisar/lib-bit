<table class="table table-striped table-bordered data-table">
    <thead>
    <tr>
        <th>Full Name</th>
        <th>Member Since</th>
        <th>Actions</th>
    </tr>
    </thead>

    <tbody>

    <?php foreach ($members as $member): ?>

        <tr>
            <td><a href="<?= App::createURL('/members/edit', ['id' => $member->id]) ?>"><?= $member->fullname ?></a></td>
            <td><?= $member->get_member_since() ?></td>
            <td>
                <a class="btn btn-primary btn-sm" href="<?= App::createURL('/transactions/add', ['instance_id' => $book_instance->id, 'member_id' => $member->id]) ?>">
                    <i class="lni-enter"></i> Add
                </a>
            </td>
        </tr>

    <?php endforeach; ?>

    </tbody>

</table>
