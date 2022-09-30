<?php 
namespace control\Cart;
session_start();
class Cart {
    protected $cart_contents = array();
    
    public function __construct(){
        $this->cart_contents = !empty($_SESSION['cart_contents'])?$_SESSION['cart_contents']:NULL;
		if ($this->cart_contents === NULL){
			$this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
		}
    }

	public function contents(){
		$cart = array_reverse($this->cart_contents);
		unset($cart['total_items']);
		unset($cart['cart_total']);

		return $cart;
	}

	public function get_item($row_id){
		return (in_array($row_id, array('total_items', 'cart_total'), TRUE) OR ! isset($this->cart_contents[$row_id]))
			? FALSE
			: $this->cart_contents[$row_id];
	}

	public function total_items(){
		return $this->cart_contents['total_items'];
	}
    
	public function total(){
		return $this->cart_contents['cart_total'];
	}
}