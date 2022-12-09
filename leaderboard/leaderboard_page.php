<?php 
require "../database/header.php";
include "../menu/navbar.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../menu/menu.css">
        <link rel="stylesheet" href="leaderboard.css">
    </head>
    <body>
        <form id="sort_section">
            <fieldset class="center">
            <legend><h1>Leaderboard</h1></legend>
                Sort By:
                <input type=button id="Most Wins" onclick=sort(this.id) value="Most Wins">
                <input type=button id="Least Wins" onclick=sort(this.id) value="Least Wins">
                <input type=button id="Most Games" onclick=sort(this.id) value="Most Games">
                <input type=button id="Least Games" onclick=sort(this.id) value="Least Games">
                <input type=button id="Most Time" onclick=sort(this.id) value="Most Time">
                <input type=button id="Least Time" onclick=sort(this.id) value="Least Time">
            </fieldset>
        </form>
        <table id=leaders_tbl>
        <tr>
       
        </tr>
        </table>
        <script src="leader_sort.js"></script>
    </body>
</html>
