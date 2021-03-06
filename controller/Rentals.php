<?php

class Rentals extends BaseController {
	public function index($pg=0) {
		$skip = 0;
		if ($pg !== 0) {
			$pg = substr($pg, 1);
			$skip = $pg*2-2;
		}
		$this->data['title'] = 'Rentals';
		$this->data['rentals'] = DBRentals::getAllRentals($skip);
		$total_rents_num = DBRentals::totalRentalsNum();
		$this->data['pagination_links'] = $this->preparePaginationLinks($total_rents_num->total_rents, $pg);
		$this->show_view('rentals');
	}
	public function singleRental($id) {
		$this->data['title'] = 'Single Rental';
		$this->data['rental'] = DBRentals::getSingleRental($id);
		$this->show_view('rental');
	}
	public function addNewRental($client, $title1, $title2, $title3, $title4, $title5, $is_ajax = false) {
		$num_of_films_at_client = DBRentals::numOfFilmsAtClient($client);
		$num_of_films_in_curr_rent = 0;
		$method_args = func_get_args();
		unset($method_args[0]);
		unset($method_args[6]);
		$films_av = true;
		$unav_films = [];
		foreach ($method_args as $key => $value) {
			if ($value != '') {
				$num_of_films_in_curr_rent++;
				if (!DBFilms::currFilmStock($value)->current_stock > 0) {
					$films_av = false;
					$unav_films[$key] = $value;
				}
			}
		}
		try {
			if ($num_of_films_at_client->stock >= 5) {
				throw new Exception("The client already rented max num of films");
			}
			try {
				if ($num_of_films_at_client->stock + $num_of_films_in_curr_rent > 5) {
					$av = 5 - $num_of_films_at_client->stock;
					throw new Exception("The client can rent " . $av . " more film/s.");
				}
				try {
					if ($films_av == false) {
						
						throw new FilmUnaviableException($unav_films);
					}
					$req = DBRentals::insertRentalIntoDB($client, $title1, $title2, $title3, $title4, $title5);
					if ($req) {
					// if (false) {
						Msg::createMessage("msg3", "Success.");
					} else {
						Msg::createMessage("msg3", "Unsuccess.");
					}
					if(!$is_ajax) {
						header("Location: ".INCL_PATH);
					} else {
						return Msg::getMessage();
					}
					
				} catch (FilmUnaviableException $e) {
					foreach ($e->getData() as $key => $value) {
						Msg::createMessage("unav_film_msg" . $key, "This film is not aviable for rent.");
					}
					return Msg::getMessage();
				}
			} catch (Exception $e) {
				Msg::createMessage("msg3", $e->getMessage());
				return Msg::getMessage();
			}
			
		} catch (Exception $e) {
			Msg::createMessage("msg3", $e->getMessage());
			return Msg::getMessage();
		}		
	}
	public function closeRental($id_rental, $id_client, $is_ajax = false) {
		$req = DBRentals::closeRental(intval($id_rental), intval($id_client));
		if(!$is_ajax) {
			header("Location: ".INCL_PATH."Rentals/{$id_rental}");
		}
	}
}