<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<br><hr>
<p>Debug below, Disable me in view/guess/play.php</p>
<hr>
<pre>
    $_SESSION

    <?=var_dump($_SESSION) ?>
    <hr>
    $_POST

    <?=var_dump($_POST) ?>
    <hr>
    $_GET

    <?=var_dump($_GET) ?>
</pre>
