<!DOCTYPE html>
<?php


?>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>You are approved for {{$conference}}!</h2>

        <div>
          Congratulations! An administrator has approved you or one of your
          participants to join the upcoming conference: {{$conference}}.
          <br>
          You will receive more information closer to the conference when they
          are available.
          <br>
          <br>
          The following participant was approved:
          <br>
          <br>
          {{$participant}}
          <br>
          <br>
          Other members in your groups might still be under consideration for
          approval. You will receive additional emails when they are approved.
          <br>
          <br>
          Have a nice day,
          <br>
          Gobind Sarvar Conference Management System
        </div>

    </body>
</html>
