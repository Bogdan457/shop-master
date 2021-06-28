<?php 
include $_SERVER["DOCUMENT_ROOT"] ."/configs/db.php";
$page = "Orders";

include $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/header.php";

    ?>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
  </ol>
</nav>

    <?php


?>
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">
                        Заказы
                    </h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>ID</th>
                            <th>user_id</th>
                            <th>products</th>
                            <th>address</th>
                            <th>статус</th>
                        </thead>
                        <tbody>
                            <?php 

                                $sql =  "SELECT * FROM orders ORDER BY id DESC";
                                $result = $conn->query($sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                            <tr>
                                <td><?php echo $row['id']?></td>
                                <td><?php echo $row['user_id']?></td>
                                <td><?php echo $row['address']?></td>
                                <td><?php echo $row['status']?></td>
                               

                                <td>

                                    
                            <div class="btn-group" role="group" aria-label="Basic example">
                              <a href="modules/products/zakaz.php?id=<?php echo $row['id']?>" class="btn btn-primary">Заказ</a>
                              <a href="modules/products/product.php?id=<?php echo $row['id']?>" class="btn btn-primary">Продукт</a>
                            </div>

                                </td>

                            </tr>
                                
                                    <?php
                                }
                                
                            ?>
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php 
include "parts/footer.php";
?>