<?php

class BaseController {
	public $data = [];

	public function show_view($view) {
		
		require 'view/includes/header.php';
		(isset($_SESSION['loged']))?require 'view/includes/navigation.php':false;
		require 'view/'.$view.'.php';
		require 'view/includes/footer.php';
	}
	public function preparePaginationLinks($total_num, $pg) {
		$pag_links_limit = 3;
		$num_of_showed_res = 2;
		$pg_num = ceil($total_num/$num_of_showed_res);
		$links = array();
		if ($pg_num < $pag_links_limit) {
			$pag_links_limit = $pg_num;
		}
		$after = floor($pag_links_limit/2);
		$before = $pag_links_limit - $after -1;
		if ($pg <= $before) {
			$before = $pg - 1;
			$after = $pag_links_limit - $before - 1;
		}
		if ($pg_num <= $pg + $after) {
			$after = $pg_num - $pg;
			$before = $pag_links_limit - $after - 1;
		}
		if ($pg == 1) {
			array_push($links, ['p1', 'Previous']);
		} else {
			array_push($links, ['p'.($pg-1), 'Previous']);
		}
		for ($i=$pg - $before; $i <= $pg + $after; $i++) { 
			array_push($links, ['p'.$i, $i]);
		}
		if ($pg == $pg_num) {
			array_push($links, ['p'.$pg, "Next"]);
		} else {
			if ($pg == 0) {
				array_push($links, ['p2', "Next"]);
			} else {
				array_push($links, ['p'.($pg+1), "Next"]);
			}
		}
		return $links;
	}
}