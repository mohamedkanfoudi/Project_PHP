<table class="table table-striped">
    <tr>
        <th>REF</th>
        <th>NAME</th>
        <th>TYPE</th>
        <th>PRICE</th>
        <th>SHIPPING</th>
        <th>DESCRIPTION</th>
        <th>MANUFACTURER</th>
        <th>IMAGE_URL</th><!--afficher image ! -->
        <th></th>
        <th></th>
    </tr>

    <?php foreach($products as $product): ?>
        <tr>
            <td><?= $product['ref'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['type'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['shipping'] ?></td>
            <td><?= $product['description'] ?></td>
            <td><?= $product['manufacturer'] ?></td>
            <td><?= $product['image'] ?></td>

            
            <td><a href="del.php?id=<?= $user['ref'] ?>" class = "btn btn-warning">X</a></td>
            <td><a href="edit.php?id=<?= $user['ref'] ?>" class = "btn btn-success">E</a></td>
        </tr>

    <?php endforeach; ?>

    </table>
</div>