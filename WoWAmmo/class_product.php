<?php
include_once "class_query.php";
include_once "class_form.php";

class Product
{
	protected $id;
	protected $name;
	protected $price;
	protected $category_id;
	protected $category_name;

	public function __construct($product = NULL)
	{
		if(isset($product))
		{
			$this->id = $product["id"];
			$this->name = $product["name"];
			$this->price = $product["price"];
			$this->category_id = $product["category_id"];
			$query = "SELECT name FROM categories WHERE id = ?";
			$array = array($this->category_id);
			$SQL = new Query($query, array($this->category_id));
			$this->category_name = $SQL->SQLquery()[0]["name"];
		}
		else
		{
		if(isset($_POST["name"]))
		{
			$this->add_cat($_POST);
		}
		$this->form_new_cat();
		}
	}

	public function getId()
	{
		return($this->id);
	}

	public function getName()
	{
		return($this->name);
	}

	public function getPrice()
	{
		return($this->price);
	}

	public function getCategory_id()
	{
		return($this->category_id);
	}

	public function getCategory_name()
	{
		return($this->category_name);
	}

	public function form_new_cat()
	{
		$query = "SELECT name FROM categories";
		$SQL = new Query($query,array());
		$categories = $SQL->SQLquery();

		echo '<form method="post"><label for="name">Category name: </label><input type="text" name="name" id="name" required/>';
		echo '<label for="parent">From: </label><select id="parent" name="parent">';
		echo '<option value=NULL>None</option>';
		foreach ($categories as $key => $value)
		{
			echo '<option value='.$value["name"].'>'.$value["name"].'</option>';
		}

		echo '</select><button type="submit">Add Category</button></form>';
	}


	public function add_cat($new_cat)
	{
		if ($new_cat["parent"] != "NULL")
		{
			$parent_id = $this->getCategory_id_from_name($new_cat["parent"])[0]["id"];
		}
		else
		{
			$parent_id = NULL;
		}

		if(!isset($this->getCategory_id_from_name($new_cat["name"])[0]))
		{
			$query = "INSERT INTO categories VALUES (NULL, ?,?)";
			$variable = array($_POST["name"],$parent_id);
			$SQL = new Query($query, $variable);
			$SQL->SQLquery();
			echo "Category added.";
		}
		else
		{
			echo "This product is already in our database. Stop wasting time and return to work.";
		}	
	}

	private function getCategory_name_from_id($category_id)
	{
		$query = ("SELECT name FROM categories WHERE id = ?");
		$variable = (array($category_id));
		$SQL = new Query($query, $variable);
		$category_name = $SQL->SQLquery();
		return($SQL->SQLquery()[0]["name"]);
	}

	private function getCategory_id_from_name($category_name)
	{
		$query = ("SELECT id FROM categories WHERE name = ?");
		$variable = (array($category_name));
		$SQL = new Query($query, $variable);
		return($SQL->SQLquery());
	}
}
?>