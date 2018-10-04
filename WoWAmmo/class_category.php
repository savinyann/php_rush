<?php
include_once "class_query.php";

class Category
{

	public function __construct($id = NULL)
	{
		if($id == NULL)
		{
			$this->list_generator(0);
		}
		else
		{
			$this->disp_id($id);
		}
	}


	private function list_generator($id)
	{
		$query = "SELECT id, name FROM categories WHERE parent_id = ?";
		$variable = array($id);
		$SQL = new Query($query, $variable);
		$cat = $SQL->SQLquery();
		if($cat != array())
		{
			
			echo '<ul>';
			foreach ($cat as $key => $value)
			{
				echo '<li class="my_list">


				<a href="index.php?cat_id='.$value["id"].'" class="my_link">'.$value["name"].'</a>';
				$this->list_generator($value["id"]);
				echo '</li>';
			}
			echo '</ul>';
		}
	}


	private function disp_id($id)
	{
		$no_product = TRUE;
		$products = array();
		$query = "SELECT * FROM products INNER JOIN (SELECT categories.id AS cat_id,categories.name AS 'category', parent.name AS 'parent category' from categories INNER JOIN categories AS parent ON categories.parent_id = parent.id) AS cat ON cat.cat_id = products.category_id WHERE category_id = $id";
		$variable = array();
		$SQL = new Query($query, $variable);
		$res = $SQL->SQLquery();
		foreach ($res as $key => $value)
		{
			foreach ($value as $subkey => $subvalue)
			{
				if(!is_integer($subkey))
				{
					$products[$key][$subkey] = $subvalue;
				}

			}
			$this->card($value);
			$no_product = FALSE;
		}
		echo ($no_product) ? "<p class=nopo>No products here. Check our subcategories please.</p>" : "";
		
	}

	private function card($item)
	{
		echo '<div class="col m4"><div class="card"><div class="card-image">';
		echo '<img src='.$item["picture"].'></div>';
		echo '<div class="card-content">';
		foreach ($item as $key => $value)
		{
			if($key != "picture" && !is_integer($key) && substr($key,-2,2) != "id")
			{
				echo '<p class="blopy">'.$value.'</p>';
			}
		}
		echo '</p></div><div class="card-action blopy"><a href="#">Purchase</a></div></div></div>';
	}
}
?>