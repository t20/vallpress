<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>{{Sitename}}</title>
        <link rel="stylesheet" href="style.css" type="text/css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <h1>{{SITENAME}}</h1>
                <h3>{{TAGLINE}}</h3>
                <h3>{{GIVE FEEDBACK MESSAGE}}</h3>
            </div>
            <div id="write_tools">
                
            </div>
            <div id="write">
                <form action="queue.php" method="POST">
                    <textarea name="message_box" id="message_box"></textarea>
                    <p><input type="submit" value="Write" name="submit"></p>
                </form>
            </div>
            <div id="content">
                <?php include 'message.php'; ?>
            </div>
        </div><!--end wrapper-->
    </body>
</html>