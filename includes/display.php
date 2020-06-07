<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <style>
    body {
        background: #c3f9fa }
    section {
        background: black;
        color: white;
        border-radius: 1em;
        padding: 1em;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-right: -50%;
        transform: translate(-50%, -50%) }
  </style>
  <section>
    <h1>LOGIN SUCCESSFULL</h1>
      <span>Redirecting....</span>
<?php header("refresh:1,url=../admin"); ?>
  </section>
</html>    