<?php
require_once 'lib.php';

$input = isset($_POST['input']) ? $_POST['input'] : '';
$custid = isset($_POST['custid']) ? $_POST['custid'] : '';

if (empty($custid)) {
    $custid = md5(time());
}

if (!empty($input)) {
    $data = curl_post(
        "http://www.pandorabots.com/pandora/talk-xml",
        array(
             "botid" => "ca23523f0e343a3c",
             "input" => $input,
             "custid" => $custid
        ));

    if (!empty($data)) {
        $simpleXMLDoc = new SimpleXMLElement($data);
        $response = $simpleXMLDoc->that;
    }
}
?>
<html>
<head>
    <title>Pagoda Bot</title>
</head>
<body>
<?php if (!empty ($input) && !empty ($response)) { ?>
<strong>You said: </strong> <?php echo $input; ?> <br/>
<strong>Pagoda Bot: </strong> <?php echo $response; ?> <br/>
    <?php } ?>
<br/>

<form method="POST">
    <input name="input" type="text"/>
    <input type="hidden" value="<?php echo $custid; ?>"/>
    <input type="submit" value="Talk"/>
</form>

<br/>
<a href="https://github.com/masnun/Pagoda-Box-App">Source Code</a>
</body>
</html>