<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $this->data['title']; ?></title>
		<link rel="stylesheet" type="text/css" href="<?php  echo INCL_PATH.'assets/css/bootstrap.css'?>">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<table class="table table-hover"">
					<caption>List of rentals</caption>
					<thead class="thead-dark">
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Client</th>
					      <th scope="col">Total</th>
					      <th scope="col">Created</th>
					      <th scope="col">Due</th>
					      <th scope="col">Opened</th>
					    </tr>
					</thead>
					<tbody>
						<?php
						foreach ($this->data['rentals'] as $key => $value) {
						?>
							<tr style="cursor: pointer;">
						      <th scope="row" onclick="document.location.href='<?php echo INCL_PATH.'Rentals/'.$value->id; ?>'"><?php echo $key+1; ?></th>
						      <td onclick="document.location.href='<?php echo INCL_PATH.'Rentals/'.$value->id; ?>'"><?php echo $value->client; ?></td>
						      <td onclick="document.location.href='<?php echo INCL_PATH.'Rentals/'.$value->id; ?>'"><?php echo $value->totals; ?></td>
						      <td onclick="document.location.href='<?php echo INCL_PATH.'Rentals/'.$value->id; ?>'"><?php echo $value->created; ?></td>
						      <td onclick="document.location.href='<?php echo INCL_PATH.'Rentals/'.$value->id; ?>'"><?php echo $value->due; ?></td>
						      <td onclick="document.location.href='<?php echo INCL_PATH.'Rentals/'.$value->id; ?>'"><?php echo ($value->opened == 0)?'No':'Yes'; ?></td>
						    </tr>
						<?php
						}
						?>
					 </tbody>
				</table>
				<nav aria-label="Page navigation example">
				    <ul class="pagination justify-content-center">
					    <li class="page-item disabled">
					        <a class="page-link" href="#" tabindex="-1">Previous</a>
					    </li>
					    <li class="page-item"><a class="page-link" href="#">1</a></li>
					    <li class="page-item"><a class="page-link" href="#">2</a></li>
					    <li class="page-item"><a class="page-link" href="#">3</a></li>
					    <li class="page-item">
					        <a class="page-link" href="#">Next</a>
					    </li>
				    </ul>
				</nav>
			</div>
		</div>
	</body>
</html>