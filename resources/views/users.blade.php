<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de usuarios</title>
</head>
<body>
    <h1> VISTA USUARIOS</h1>

    <ul>
    <?php foreach ($users as $user): ?>
        <li><?php echo $user ?></li>
    <?php endforeach; ?>  
    </ul>  
</body>
</html>
