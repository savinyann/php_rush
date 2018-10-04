<?php
include_once "class_query.php";
//include_once "";
class Search
{
	private $query;
	private $variable = array();

	public function __construct()
	{
		$column = array();
		$query = "DESC products";
		$SQL = new Query($query);
		$fields = $SQL->SQLquery();
		foreach ($fields as $key => $value)
		{
			if($value["Field"] == "category_id")
			{
				$value["Type"] = "var";
				$value["Field"] = "category";

			}
			$column[substr($value["Type"],0,3)."_".$value["Field"]] = strtoupper(substr($value["Field"],0,1)).substr($value["Field"],1);
		}
		new Form($column, "Search !");
	}

	public function research($search)
	{
		$this->build_query($search);
		$match = $this->look_for();
		if($match == array())
		{
			echo "No match found";
			return(NULL);
		}
		else
		{
			$this->display($match);
			return($match);
		}
	}


	private function build_query($search)
	{
		$this->query = "SELECT * FROM products INNER JOIN (SELECT categories.id AS cat_id,categories.name AS 'category', parent.name AS 'parent category' from categories INNER JOIN categories AS parent ON categories.parent_id = parent.id) AS cat ON cat.cat_id = products.category_id WHERE ";
		$first_field = TRUE;
		foreach ($search as $key => $value)
		{
			if($value != "")
			{/*
				if($key == "var_category")
				{
					$value = $this->getCategory_id_from_name($value);
					echo "<br>";
					var_dump($value);
					exit();
				}*/
				$this->query .= ($first_field == FALSE) ? " AND " : "";
				$this->query .= substr($key,4)." like ?";
				$this->variable[] = "%".$value."%";
				$first_field = FALSE;
			}
		}
	}


	private function look_for()
	{
		$match = array();
		$SQL = new Query($this->query, $this->variable);
		$find = $SQL->SQLquery();
		foreach ($find as $key => $value)
		{
			foreach ($value as $subkey => $subvalue)
			{
				if(!is_integer($subkey))
				{
					$match[$key][$subkey] = $subvalue;
				}

			}
		}
		return($match);
	}


	private function display($match)
	{
		foreach ($match as $value)
		{
				$this->card($value);
		}
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
				echo '<p>'.$value.'</p>';
			}
		}
		echo '</p></div><div class="card-action"><a href="#">Purchase</a></div></div></div>';
	}


		private function getCategory_id_from_name($category_name)
	{
		$query = ("SELECT id FROM categories WHERE name like ?");
		$variable = (array("%".$category_name."%"));
		$SQL = new Query($query, $variable);
		return($SQL->SQLquery());
	}
}
?>
