<?php

class InterestsManager{
	private $connection;
	
	function __construct($mysqli){
		
		// selle klassi muutuja
		$this->connection = $mysqli;
		
		
	
	}
	
	
	function addInterest($new_interest){
		// kas selline huviala on olemas?
		// kui ei ole siis lisame juurde
		
		$response = new StdClass();
		$stmt = $this->connection->prepare("SELECT id FROM interests WHERE name = ?");
		$stmt->bind_param("s", $new_interest);
		$stmt->execute();
		
		// ei ole sellist kasutajat - !
		if($stmt->fetch()){
			
			// saadan tagasi errori
			$error = new StdClass();
			$error->id = 0;
			$error->message = "Sellist huviala on olemas!";
			
			//panen errori responsile külge
			$response->error = $error;
			
			// pärast returni enam koodi edasi ei vaadata funktsioonis
			return $response;
		
		}
		$stmt->close();
	
		$stmt = $this->connection->prepare("INSERT INTO interests (name) VALUES (?)");
		$stmt->bind_param("s", $new_interest);
		
		if($stmt->execute()){
			// edukalt salvestas
			$success = new StdClass();
			$success->message = "Huviala edukalt salvestatud";
									
			$response->success = $success;
			
		}else{
			// midagi läks katki
			$error = new StdClass();
			$error->id =1;
			$error->message = "Midagi läks katki!";
			
			//panen errori responsile külge
			$response->error = $error;
		}
		
		$stmt->close();
		
		//saada tagasi vastuse, kas success või error
		return $response;
	}

		function createDropDown(){
			$html = '';
			$html .= '<select name="dropdownselect">';
			
			$stmt = $this->connection->prepare("SELECT name FROM interests");
			$stmt->bind_result($name);
			$stmt->execute();
			
			while($stmt->fetch()){
				$html .= '<option>'.$name.'</option>';
				
			}
			$stmt->close();
			
			//$html .= '<option value="2" selected>Teisipäev</option>';
			
			$html .= '</select>';	
				
			return $html;
			
			
		}

}?>