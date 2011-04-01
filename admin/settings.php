<?php include 'admin_header.php'; ?>
   <form action="" method="POST" accept-charset="utf-8">
       <label for="sitename">Site Name</label><input type="text" name="sitename" value="" id="sitename"/>
       <label for="tag_line">Tag Line</label><input type="text" name="tag_line" value="" id="tag_line"/>
       <label for="user_name">User Name</label><input type="text" name="user_name" value="" id="user_name"/>
       <label for="password">Password</label><input type="password" name="password" value="" id="password"/>
       <p>Leave Blank to leave unchanged.</p>
       <p><input type="submit" value="Submit"></p>
   </form>

<?php include 'admin_footer.php'; ?>