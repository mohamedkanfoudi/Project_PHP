<?php
$pdo = new PDO(
    "mysql:host=localhost;dbname=boutique",
    "root",
    ""
);

$json_file=file_get_contents("products.json");
$products = json_decode($json_file, true);

$n=0;
foreach($products as $product)
    {
        $n=$n+1;

        $ref=$product["ref"];
        $name=$product["name"];
        $type=$product["type"];
        $price=$product["price"];
        $shipping=$product["shipping"];
        $description=$product["description"];
        $manufacturer=$product["manufacturer"];
        $image=$product["image"];


        $query1="INSERT INTO products (ref,name,type,price,shipping,description,manufacturer,image) VALUES (?,?,?,?,?,?,?,?)";
        $stmt1= $pdo->prepare($query1);
        $stmt1->execute([$ref,$name,$type,$price,$shipping,$description,$manufacturer, $image]);
        
        
        for($i=0;$i < count($product["category"]);$i++)
        {
        $id=$product["category"][$i]["id"];
        $name=$product["category"][$i]["name"];

        $query2 = "INSERT INTO categories(ref,id,name) VALUES(?,?,?)";
        $stmt2= $pdo->prepare($query2);
        $stmt2->execute([$ref,$id,$name]);
        }
    }
    print_r("Done");
?>