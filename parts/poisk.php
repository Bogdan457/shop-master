	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Поиск</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
					<form class="d-flex" id="poisk" action="http://shop-master.local/test.php" method="POST">
					 <input class="form-control me-2" type="search" name="title" placeholder="Найти.." maxlength="20">
					 <button class="btn btn-outline-success">Найти</button>
					</form>
					<?php include './test.php'; ?>
	      </div>
	    </div>
	  </div>
	</div>

  <?php
     include $_SERVER["DOCUMENT_ROOT"] . "/configs/db.php";
  ?>
