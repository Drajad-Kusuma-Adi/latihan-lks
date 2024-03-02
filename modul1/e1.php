<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E1 - XML2JSON</title>
</head>

<body>
    <form action="" method="post">
        <label for="xmlInput">XML</label>
        <textarea name="xmlInput" id="xmlInput" cols="30" rows="10" placeholder="XML input goes here..."></textarea>
        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["xmlInput"]) && !empty($_POST["xmlInput"])) {
            $xml = $_POST["xmlInput"];
            $json = convertXmlToJson($xml);
            echo "<pre>";
            print_r(json_encode(json_decode($json), JSON_PRETTY_PRINT));
            echo "</pre>";
        } else {
            echo "No XML data provided.";
        }
    }

    function convertXmlToJson($xml)
    {
        $json = json_encode(simplexml_load_string($xml));
        return $json;
    }
    ?>
</body>

</html>