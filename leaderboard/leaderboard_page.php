<?php 
require "../database/header.php";
include "../menu/navbar.html";
?>
<!DOCTYPE html>
<html>
    <head><link rel="stylesheet" href="../menu/menu.css"></head>
    <body>
    <!-- <div class="topnav">
        <a href="../connect4.php">Play</a>
        <a class="active" href="help.html">Instructions</a>
        <a href="../leaderboard/leaderboard_page.php">Leaderboard</a>
        <a href="contact_us.html">Contact Us</a>
    </div>  -->
        <form>
            <fieldset>
            <legend><h1>Leaderboard</h1></legend>
                Sort By:
                <input type=button onclick=sort(this.value) value="Most Wins">
                <input type=button onclick=sort(this.value) value="Least Wins">
                <input type=button onclick=sort(this.value) value="Most Games">
                <input type=button onclick=sort(this.value) value="Least Games">
                <input type=button onclick=sort(this.value) value="Most Time">
                <input type=button onclick=sort(this.value) value="Least Time">
            </fieldset>
        </form>
        <table id=leaders_tbl></table>
        <script src="leader_sort.js"></script>
    </body>
</html>
