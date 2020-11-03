<?php
class AI_Product{
	private $_id;
    private $_row;
	function __construct($id){
		$this -> _id = $id;
		$CI =& get_instance();
		$row = $CI -> Product_model -> getProduct($id);
		$this -> _row = $row;
	}

    function title($chars  = false){
        if($chars){
            return substr($this -> data('ptitle'), 0, $chars) . '...';
        }
        return $this -> data('ptitle');
    }

	function ID(){
		return $this -> _id;
	}

    function isPublished(){
        $st = $this -> data('published');
        if($st == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }

	function data($key){
        if(property_exists($this -> _row, $key)){
            return $this -> _row -> $key;
        }else{
            return FALSE;
        }
	}

	function hasImage(){
		if(isset($this -> row['image'])){
			return true;
		}else{
			return false;
		}
	}

	function description(){
		return $this -> row['description'];
	}


	function excerpt(){
		if($this -> data('excerpt') <> ''){
			return $this -> data('excerpt');
		}else{
			$text = $this -> description();
			$text = strip_tags($text);
			$text = word_limiter($text, 30);
			return $text;
		}
	}

	function metaTitle(){
		return $this -> data('meta_title');
	}

	function metaDescription(){
		return $this -> data('meta_description');
	}

	function metaKeywords(){
		return $this -> data('meta_keywords');
	}

	function permalink(){
		$link = site_url('details/' . $this -> data('slug').'/'. $this -> _id);
		return $link;
	}

	function image($size = 'sm', $options = array()){
		$str = '<img src="' . base_url(upload_dir($this -> data('image'))) . '" alt="' . $this -> title(). '" title = "' . $this -> title() . '" ' . $this -> __arr_to_str($options) . ' />';
		return $str;
	}

	private function __arr_to_str($arr){
		$str = '';
		foreach($arr as $key => $value){
			$str .= $key . '="' . $value . '" ';
		}
		return $str;
	}

    function price(){
        $prices = $this -> _row -> prices;
        $price = "Not Available";
        if(is_array($prices) && count($prices) > 0){
            $price = 9999999999;
            foreach($prices as $prow){
                if($prow -> sale_price < $price){
                    $price = $prow -> sale_price;
                }
            }
        }
        return '<i class="fa fa-inr"></i> ' .  $price;
    }

    function store_count(){
        $prices = $this -> _row -> prices;
        $str = "Not Available";
        if(is_array($prices) && count($prices) > 0){
            $scount = count($prices);
            $str = $scount . ' stores at ' . $this -> price();
        }
        return $str;
    }

    function stores(){
        $CI =& get_instance();
        $prices = $this -> _row -> prices;
        $data = array();
        foreach($prices as $row){
            $store= $CI -> db -> get_where('ecomm', array('id' => $row -> ecomm_id)) -> first_row();
            $row -> store = $store -> ecomsite;
            $row -> logo = $store -> logo;
            $data[] = $row;
        }
        return $data;
    }

    function lowestStore(){
        $CI =& get_instance();
        $prices = $this -> _row -> prices;
        $price = "Not Available";
        $row = array();
        if(is_array($prices) && count($prices) > 0){
            $price = 9999999999;
            foreach($prices as $prow){
                if($prow -> sale_price < $price){
                    $row = $prow;
                }
            }
        }
        $store= $CI -> db -> get_where('ecomm', array('id' => $row -> ecomm_id)) -> first_row();
        $row -> store = $store -> ecomsite;
        $row -> logo = $store -> logo;
        return $row;
    }

    function store_logo($id){
        $stores = $this -> stores();
        $row = '';
        foreach($stores as $st){
            if($st -> ecomm_id == $id){
                $row = $st;
            }
        }
        if($row -> logo <> ''){
            echo '<img src="'.$row -> logo.'" class="store-logo" alt="'.$row -> store.'" title="'.$row -> store.'" />';
        }else{
            echo $row -> store;
        }
    }

    function stars(){
        ?>
        <div class="product-rating">
            <?php
            $c = $this -> _row -> rating;
            for($i = 1; $i <= floor($c / 2); $i++ ){
                ?>
                <i class="fa fa-star"></i>
            <?php
            }
            if($c % 2 > 0){
                ?>
                <i class="fa fa-star-half"></i>
            <?php
            }
            echo '(' . $c / 2 . ')';
            ?>
        </div>
        <?php
    }
}
