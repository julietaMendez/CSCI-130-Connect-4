<?php 
require "../header.php";
?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
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
