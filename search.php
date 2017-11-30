<?php

require("conf.php");

$q = $_GET["q"];
$r = $_GET["r"];

$results = array();
$rows = 0;

if (isset($q)) {
    // Exploitable method
    $link = mysqli_connect("$mysql_host:$mysql_port", $mysql_user, $mysql_pw, $mysql_db);

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s: %s\n", mysqli_connect_errno(), mysqli_connect_error());
        exit();
    }

    $query = "SELECT `id`, `name`, `id` FROM `places` WHERE name='$q'";
    if (mysqli_multi_query($link, $query) or die(mysqli_error($link)) )
    {
        do {
            $res = mysqli_store_result($link);
            $rows = mysqli_num_rows($res);
            $results = mysqli_fetch_all($res);

        } while (mysqli_next_result($link));
    }
}
else if (isset($r)) {
    try {
        $pdo = new PDO("mysql:dbname=$mysql_db;host=$mysql_host:$mysql_port", $mysql_user, $mysql_pw);
        $res = $pdo->prepare("SELECT `id`, `name`, `id` FROM `places` WHERE name=:query");
        $res->bindParam("query", $r);
        $res->execute();
        $results = $res->fetchAll();
        $rows = $res->rowCount();
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}
else {
    header("Location: index.php");
}
?>
<HTML>
<HEAD>
    <TITLE>Exploitable or non-explotiable Search Form - CS4900 - Tim and Matthew</TITLE>
</HEAD>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<BODY style="padding-top: 60px;">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">SQL Exploit Example</a>
        </div>
    </div>
</nav>

<div class="container">
    <H1>Search Results <small><?= isset($q) ? $q : ""?><?= isset($r)? $r : "" ?></small></H1>
    <table class="table table-striped table-bordered">
        <tr><th>ID</th><th>Name</th><th>&nbsp;</th></tr>
<?php

if ($rows > 0) {

    foreach($results as $row) {
        echo <<<ENDL
<tr><td>$row[0]</td><td>$row[1]</td><td><a href="site.php?id=$row[2]">More Information</a></td></tr>
ENDL;

    }
}
else {
    echo("<tr><td colspan='3'><span class='text-danger'>No results found</span></td>");
}
?>
    </table>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</BODY>
</HTML>
