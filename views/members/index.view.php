<?php include_once "views/_header.php" ?>

<?php

/** @var Member[] $members */
$members = Member::select_all();

?>


    <div class="container">

        <div class="row">
            <div class="col">
                <h1 class="text-center">Books list</h1>
            </div>
        </div>

        <div class="row">

            <div class="col">

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Member Since</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($members as $member): ?>

                        <tr>
                            <td><a href="<?= App::createURL('/members/edit', ['id' => $member->id]) ?>"><?= $member->fullname ?></a></td>
                            <td><?= $member->get_member_since() ?></td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>


    </div>

<?php include_once "views/_footer.php" ?>