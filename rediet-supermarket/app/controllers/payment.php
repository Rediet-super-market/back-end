<?php 

Class Payment extends Controller
{

	public function index()
	{
		
		$data = file_get_contents('php://input');
		

		//$filename = time() . "_.txt";
		//file_put_contents($filename, $data);

		$obj = json_decode($data);
		$DB = Database::newInstance();

		if(is_object($obj)){

			$arr = array();
			$arr['payment_id'] 	= $obj->id;
			$arr['amount'] 		= $obj->resource->purchase_units[0]->amount->value;
			$arr['order_id']	= $obj->resource->purchase_units[0]->description;
			$arr['status'] 		= $obj->resource->status;
			$arr['email'] 		= $obj->resource->payer->email_address;
			$arr['user_id'] 	= $obj->resource->payer->payer_id;
			$arr['payment_date'] 		= date("Y-m-d H:i:s");

			$query = "insert into payments (

				payment_id,amount,order_id,status,email,user_id,payment_date
			) values (

			:payment_id,:amount,:order_id,:status,:email,:user_id,:payment_date
			)";
			$DB->write($query,$arr);
 
		}
 		
	}


}