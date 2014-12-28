<?php
require_once 'GenderFlip.php';

if (isset($_GET['url']) && filter_var($_GET['url'], FILTER_VALIDATE_URL)) {
    $genderFlip = new GenderFlip(file_get_contents($_GET['url']));
    echo $genderFlip->flip();
    exit;
} elseif (isset($_GET['example'])) {
    switch ($_GET['example']) {
        case 'alice-in-wonderland':
            $path = 'examples/11-h.htm';
            break;
        case 'peter-pan':
            $path = 'examples/16-h.htm';
            break;
        case 'pride-and-prejudice':
        default:
            $path = 'examples/1342-h.htm';
    }
    $genderFlip = new GenderFlip(file_get_contents($path));
    echo $genderFlip->flip();
    exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Gender Flip</title>
</head>
<body>
    <h1>Gender Flip</h1>
    <h2>By URL</h2>
    <form>
        <input type="url" name="url" placeholder="Enter a URL">
        <input type="submit" value="Submit">
    </form>
    <h2>By Example</h2>
    <a href="?example=pride-and-prejudice">Pride and Prejudice</a><br>
    <a href="?example=peter-pan">Peter Pan</a><br>
    <a href="?example=alice-in-wonderland">Alice in Wonderland</a>
</body>
</html>
