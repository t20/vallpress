<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>{{Sitename}}</title>
        <link rel="stylesheet" href="style.css" type="text/css" media="screen" title="no title" charset="utf-8">
        <script src="static/js/jquery-1.4.4.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="static/js/jquery-ui-1.8.10.custom.min.js" type="text/javascript" charset="utf-8"></script>
        <script >
        	$(function() {
        		$( "#moods" ).buttonset();
        	});
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <h1>{{SITENAME}}</h1>
                <h3>{{TAGLINE}}</h3>
                <h3>{{GIVE FEEDBACK MESSAGE}}</h3>
            </div>
            <div id="write">
                <form action="process.php" method="POST">
                    <div id="moods">
                        <input type="radio" name="mood" class="ui-helper-hidden-accessible" id="radio1" value="1" ><label for="radio1"  role="button" ><img src="static/images/moods/great.png"/></label>
                        <input type="radio" name="mood" class="ui-helper-hidden-accessible" id="radio2" value="2" ><label for="radio2" role="button" ><img src="static/images/moods/smile.png"/></label>
                        <input type="radio" name="mood" class="ui-helper-hidden-accessible" id="radio3" value="3" ><label for="radio3"  role="button" ><img src="static/images/moods/sad.png"/></label>
                    </div>
                    <textarea name="message_box" id="message_box"></textarea>
                    <p><input type="submit" value="Write" name="submit"></p>
                </form>
            </div>
            <div id="content">
                <?php 
                    include 'config.php';
                    include 'includes/database.php';
                    include 'models.php';
                    include 'includes/functions.php';
                    $messages = get_messages();
                ?>
                <?php include 'messages.php'; ?>
            </div>
        </div><!--end wrapper-->
    </body>
</html>