<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Stamp Worldn't</title>
    <meta name="viewport" content="width=device-width" />
    <?php
    if($this->title=="Login"):
    ?>
    <link rel="stylesheet" href="../views/css/login.css" />
    <?php
    else:
    ?>
    <link rel="stylesheet" href="../views/css/register.css" />
    <?php endif ?>


    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    />
</head>

<body>

        {{content}}

</body>

</html>