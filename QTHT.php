<?php include_once("header.php") ?>    
<?php include_once("nav.php") ?>
<?php 
 
?>
<!--Table-->
<div class="container-fluid">
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<div class="btn-add d-flex justify-content-end align-items-center pb-3">
				<button class="btn btn-outline-primary" data-toggle="modal" data-target="#addItem"><i class="fas fa-plus-circle"></i> Thêm</button>
			</div>
			<thead class="thead-dark">
				<tr>
					<th scope="col">STT</th>
					<th scope="col">Từ năm</th>
					<th scope="col">Đến năm</th>
					<th scope="col">Lớp</th>
					<th scope="col">Nơi học</th>
					<th scope="col">Thao tác</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">1</th>
					<td>2013</td>
					<td>2016</td>
					<td>A2</td>
					<td>HBT</td>
					<td class="d-flex">
						<button class="btn btn-outline-info mr-3" data-toggle="modal" data-target="#editItem"><i class="far fa-edit"></i> Sửa</button>
            <!--data-target là khi bấm vô nó sẽ tìm chỗ nào có id giống nó để hiện ra-->
            <button class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteItem"><i class="fas fa-trash-alt"></i> Xóa</button>
					</td>
				</tr>
				<tr>
					<th scope="row">2</th>
					<td>2016</td>
					<td>2020</td>
					<td>B</td>
					<td>HUSC</td>
					<td class="d-flex">
						<button class="btn btn-outline-info mr-3" data-toggle="modal" data-target="#editItem"><i class="far fa-edit"></i> Sửa</button>
						<button class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteItem"><i class="fas fa-trash-alt"></i> Xóa</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div> <!--End table-->


<!--Edit-->
<div class="modal fade" id="editItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group ">
          <label for="from">Từ năm</label>
          <input type="number" class="form-control" id="from" placeholder="Từ năm">
          </div>
          <div class="form-group">
          <label for="to">Đến năm</label>
          <input type="number" class="form-control" id="to" placeholder="Đến năm">
          </div>
          <div class="form-group">
          <label for="class">Lớp</label>
          <input type="text" class="form-control" id="class" placeholder="Lớp">
          </div>
          <div class="form-group">
          <label for="place">Nơi học</label>
          <input type="text" class="form-control" id="place" placeholder="Nơi học">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> <!--End Edit-->

<!--Delete-->
<div class="modal fade" id="deleteItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Notice</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Do you want to delete this?</div>
			<div class="modal-footer">
				<button class="btn btn-danger" type="button" data-dismiss="modal">Delete</button>
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div> <!--End Delete-->

<!--Add-->
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group ">
          <label for="from">Từ năm</label>
          <input type="number" class="form-control" id="from" placeholder="Từ năm">
          </div>
          <div class="form-group">
          <label for="to">Đến năm</label>
          <input type="number" class="form-control" id="to" placeholder="Đến năm">
          </div>
          <div class="form-group">
          <label for="class">Lớp</label>
          <input type="text" class="form-control" id="class" placeholder="Lớp">
          </div>
          <div class="form-group">
          <label for="place">Nơi học</label>
          <input type="text" class="form-control" id="place" placeholder="Nơi học">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> <!--End Add-->

<?php include_once("footer.php") ?> 