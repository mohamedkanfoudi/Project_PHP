<?php 

$erreur = isset($_GET['error']) ? $_GET['error'] : null;

try{
    $pdo = new PDO(
        "mysql:host=localhost;dbname=boutique",
        "root",
        ""
    );
    

    $name="";
               if (isset($_GET["name"]))
               {
                   $name=$_GET["name"];
                   $name = str_replace('_',' ', $name);
               
               $stmt = $pdo->prepare("SELECT * FROM products WHERE ref in (SELECT ref FROM categories WHERE name = ?)");
               $stmt->execute([$name]);
               $products=$stmt->fetchAll(PDO::FETCH_ASSOC);
               }else{
                
                $stmt = $pdo->query("SELECT * FROM products");

                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
               }

    
    
}catch(Exception $e){
    echo '<hr><pre>';
    print_r($e->getMessage());
}


?>
<?php



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>Site Commerce | MK</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Liste des produits</h1>
    <?php if($erreur) : ?>
        <div class="alert alert-danger">
            <?= $erreur ?>
         </div>
    <?php endif ?>
    <main class="container-fluid mb-4">
       <section class="row my-4">
           <div class="col-12 col-md-9">
       <!--BEGIN BREADCRUMB-->
                <nav class="col-12">
                    <ol class="breadcrumb ">
                        <li class="breadcrumb-item"><a href="accueil.html">Accueil</a></li>
                        <li class="breadcrumb-item active">Liste de produits</li>
                    </ol>
                </nav>
       <!--FIN-->
       <!-- BEGIN PAGINATION-->
       <nav>
           <ul class="pagination justify-content-center">
               <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
               <li class="page-item active"><a class="page-link" href="#">1</a></li>
               <li class="page-item"><a class="page-link" href="#">2</a></li>
               <li class="page-item"><a class="page-link" href="#">3</a></li>
               <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
           </ul>
       </nav>
       <!--END TOP PAGINATION-->



       <div class="list-group list-group-flush">


    <?php foreach($products as $product): ?>
     <article class="list-group-item ">
                 <div class="row">
                     <div class="col-12 col-md-4">
                         <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-fluid img-thumbnail" />
                     </div>
                     <div class="col-12 col-md-8">
                         <h1 class="h3"><?= $product['name'] ?></h1>
                         <h6><?= $product['price'] ?> DH</h6>
                         <p><?= $product['description'] ?></p>
                          
                         <input action="add" type="submit" id=<?php echo $product["ref"]?> name="add_to_carte"
                                 class="btn btn-primary flex-end add_cart" value="Add to Carte">

                     </div>
                 </div>
             </article>
             <?php endforeach; ?>

         </div>
<!------------------->
       <div class="list-group list-group-flush">

       <?php foreach($products as $product): ?>
        <article class="list-group-item ">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-fluid img-thumbnail" />
                        </div>
                        <div class="col-12 col-md-8">
                            <h1 class="h3"><?= $product['name'] ?></h1>
                            <h6><?= $product['price'] ?> DH</h6>
                            <p><?= $product['description'] ?></p>
                             
                            <input action="add" type="submit" id=<?php echo $product["ref"]?> name="add_to_carte"
                                    class="btn btn-primary flex-end add_cart" value="Add to Carte">

                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
   
          
    

            
                
                
                
           
            </div>

    <!--
<form action="add.php" method="get">
    <input type="text" name="email" placeholder="Email" class="form-control">
    <input type="password" name="password" placeholder="Password" class="form-control">
    <select name="role" id="" class="form-control">
        <option value="guest">Guest</option>
        <option value="admin">Admin</option>
    </select>
    <button class="btn btn-primary">Ajouter</button>
</form>
    -->
    
<hr>

   <!-- BEGIN  BOTTOM PAGINATION-->
   <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
        </ul>
    </nav>
           </div><!--End first column-->
           <div class="col-12 col-md-3">
               <section class="card">
                   <div class="card-header bg-primary text-white">
                       <h1 class="h5">Catégories</h1>
                   </div>
                <ul class="list-group">
                    <?php
                    $stmt=$pdo->query("SELECT DISTINCT name FROM categories");
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                        foreach($rows as $categorie)
                        {
                            $name=$categorie["name"];
                            $text = str_replace(' ', '_', $name);
                            $stmt = $pdo->prepare("SELECT count(*) FROM categories WHERE name = ?");
                            $stmt->execute([$name]);
                            $count = $stmt->fetchColumn();
                            echo "<li class="."list-group-item list-group-item-action d-flex justify-content-between align-items-center"."><a href="."index.php?name=".$text.">".$name.""."</a><span class="."badge badge-pill bg-primary text-white ".">".$count."</span></li>";
                        }

                    ?>

                </ul>
               </section>
                
        </div><!--End second column-->
       </section><!--End section.row-->
   </main><!--end main.container-fluid-->


  

   <!------------------------------------->

                </div>

</body>
</html>

<hr>
