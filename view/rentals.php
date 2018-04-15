		<div class="container">
			<div class="row">
				<form class="mt-2">
					<input type="text" name="client_filter" placeholder="Filter by client's name" id="client_filter">
				</form>
				<table class="table table-hover mt-1 text-center">
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
							<tr style="cursor: pointer;" onclick="document.location.href='<?php echo INCL_PATH.'Rentals/'.$value->id; ?>'">
							    <th scope="row"><?php echo $key+1; ?></th>
							    <td><?php echo $value->client; ?></td>
							    <td><?php echo $value->totals; ?></td>
							    <td><?php echo $value->created; ?></td>
							    <td><?php echo $value->due; ?></td>
							    <td><?php echo ($value->opened == 0)?'No':'Yes'; ?></td>
						    </tr>
						<?php
						}
						?>
					 </tbody>
				</table>
				<nav>
				    <ul class="pagination justify-content-center">
					    <li class="page-item">
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