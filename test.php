<!-- HTML --> 
<form method="post">
    <button type="submit" name="my_button">Click Me</button>
</form>


<?php

// PHP
if (isset($_POST['my_button'])) {
    myFunction();
}

function myFunction() {
    echo "Button clicked!";
}


?>