<?php
/** @var BookTransaction $book_transaction */
$book_transaction = View::getData('book_transaction');

/** @var BookInstance $book_instance */
$book_instance = View::getData('book_instance');
/** @var Book $book */
$book = View::getData('book');
/** @var Member $member */
$member = View::getData('member');

?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Print Transaction #<?= $book_transaction->id ?></title>

  <style>

    .container {
      max-width: 100%;
      text-align: center;
    }

    table {
      border: solid 1px #2c2c2c;
      border-collapse: collapse;
      width: 100%;
      text-align: left;
    }

    td, tr {
      border: solid 1px #2c2c2c;
      padding: 0;
      margin: 0;
    }

    td {
      padding: 10px;
    }

  </style>

</head>
<body>

<div class="container">

  <h2>Book Transaction Receipt #<?= $book_transaction->id ?></h2>

  <table>
    <tbody>
    <tr>
      <td>Book</td>
      <td><?= $book ?></td>
    </tr>

    <tr>
      <td>Book Instance</td>
      <td><?= $book_instance ?></td>
    </tr>

    <tr>
      <td>Member</td>
      <td><?= $member ?></td>
    </tr>

    <tr>
      <td>Borrowing Date</td>
      <td><?= $book_transaction->borrowing_date ?></td>
    </tr>

    <tr>
      <td>Returning Date</td>
      <td><?= $book_transaction->returning_date ?></td>
    </tr>

    <tr>
      <td>Remarks</td>
      <td><?= $book_transaction->remarks ?></td>
    </tr>

    </tbody>
  </table>

  <div style="margin-bottom: 20px"></div>


  <table>
    <tbody>
    <tr>
      <td style="padding-top: 100px; text-align: center">Member Signature</td>
      <td style="padding-top: 100px; text-align: center">Librarian Signature</td>
    </tr>
    </tbody>
  </table>

</div>

</body>
</html>
