<?php
include $_SERVER["DOCUMENT_ROOT"] ."/configs/db.php";
$page = "categories";

include $_SERVER["DOCUMENT_ROOT"] . "/admin/parts/header.php";

    ?>
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
  </ol>
</nav>


    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">Категории
                    <a href="modules/categories/add.php" class="btn btn-warning">Добавить</a></h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>ID</th>
                            <th>category</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql =  "SELECT * FROM categories ORDER BY id DESC";
                                $result = $conn->query($sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                            <tr>
                                <td><?php echo $row['id']?></td>
                                <td><?php echo $row['title']?></td>
                                <td>

                                  <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="modules/categories/edit.php?id=<?php echo $row['id']?>" class="btn btn-primary">Редактировать</a>
                                    <a href="modules/categories/delete.php?id=<?php echo $row['id']?>" class="btn btn-primary">Удалить</a>
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
