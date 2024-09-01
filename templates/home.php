<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7 Days to Die - Items</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="size-medium">
        <h1>Items et leurs prix : </h1>
        <div class="items">
            <?php foreach($items as $item) : ?>
                <div class="item">
                    <p>Noms : </p>
                    <ul>
                        <?php foreach($item['locale'] as $lang => $trad) : ?>
                            <li><?= strtoupper($lang) . ' - ' . $trad ?></li>
                        <?php endforeach ?>
                    </ul>
                    <p>Prix : </p>
                    <ul>
                        <?php foreach($item['prices'] as $price) : ?>
                            <li><?= $price['label'] . ' - ' . $price['value'] . ' Dukes' ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</body>
</html>