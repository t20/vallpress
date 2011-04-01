<?php 
    include 'admin_header.php';
    $start = $_REQUEST['start'];
    $messages = get_messages($start, 20);
    
    include 'views/messages.php';
    
?>
   
   
   
<?php include 'admin_footer.php'; ?>