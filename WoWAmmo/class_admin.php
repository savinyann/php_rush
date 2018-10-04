<?php
include_once "class_form.php";
include_once "class_verify_input.php";
include_once "class_query.php";
include_once "class_product.php";

class Admin extends User
{


	public function del_user()
	{
		if(isset($_GET["delete"]) && isset($_GET["confirm"]))
		{
			$query = "SELECT admin FROM users WHERE id = ?";
			$variable = array($_GET["delete"]);
			$SQL = new Query($query, $variable);
			$is_admin = $SQL->SQLquery()[0]["admin"];
			if($is_admin == 0)
			{
				$query = "DELETE FROM users WHERE id = ?";
				$SQL = new Query($query, $variable);
				$SQL->SQLquery();
			}
			else
			{
				echo "You can not delete an admin.";
			}
		}
		$this->show_user('admin.php?action=del_user&delete=');
	}


	public function mod_user()
	{
		if(isset($_POST["username"]))
		{
			$verify_addUser = new Verify_input($_POST);
			$verif_all = $verify_addUser->verify_input($_GET["mod"]);
			$_POST["password"] = password_hash($_POST["password"],PASSWORD_DEFAULT);

			$query = "UPDATE users SET username = ?, password = ?, email = ? WHERE id = ?";
			$variable = array($_POST["username"],$_POST["password"],$_POST["email"], $_GET["mod"]);
			$SQL = ($verif_all) ? new Query($query,$variable) : FALSE;
			$SQL->SQLquery();
			echo "User modified";
		}

		if(isset($_GET["mod"]))
		{
			$mod_user["username"] = "Name: ";
			$mod_user["email"] = "Email: ";
			$mod_user["password"] = "Password: ";
			$mod_user["password_conf"] = "Password Confirmation: ";
			new form($mod_user, "Apply modification");
		}
		$this->show_user('admin.php?action=mod_user&mod=');
	}


	private function show_user($redirection = NULL)
	{
		$query = "SELECT id, username, admin FROM users";
		$SQL = new Query($query);
		$users = $SQL->SQLquery();
		echo '<div class="show"><ul>';
		foreach ($users as $key => $value)
		{
			echo'<li><a href='.$redirection.$value["id"].' >'.$value["username"].'</a></li>';
			if(isset($_GET["delete"]) && $_GET["delete"] == $value["id"])
			{
				new Form(array(), "Confirm",$redirection.$value["id"].'&confirm=1');
			}
		}
		echo '</ul></div>';
	}


	public function display_user()
	{
		if(isset($_GET["display"]))
		{
			$query = "SELECT * FROM users WHERE id = ?";
			$variable = array($_GET["display"]);
			$SQL = new Query($query, $variable);
			$user = $SQL->SQLquery()[0];
			$user = new User($user);
			echo "L'utilisateur #".$user->getId()." s'appelle ".$user->getUsername()." et est joignable à l'adresse mail ".$user->getEmail().". ";
			echo ($user->getAdmin()) ? "Il s'agit d'un administrateur." : "Ce n'est pas un administrateur.";
		}
		$this->show_user('admin.php?action=display_user&display=');
	}


	public function add_prod()
	{
		$add_prod["name"] = "Product name: ";
		$add_prod["price"] = "Product Price (€): ";
		$add_prod["category_name"] = "Category: ";
		if(isset($_POST["name"]))
		{
			$query = "SELECT id FROM categories WHERE name = ?";
			$variable = array($_POST["category_name"]);
			$SQL = new Query($query,$variable);
			$category_id = $SQL->SQLquery();
			if(isset($category_id[0]["id"]))
			{
				$query = "INSERT INTO products (name, price, category_id)VALUES (?,?,?)";
				$variable = array($_POST["name"],$_POST["price"],$category_id[0]["id"]);
				$SQL = new Query($query,$variable);
				$category_name = $SQL->SQLquery();
				echo "Product added.";
			}
			else
			{
				echo "invalid category name.";
			}
		}
		new form($add_prod, "Add product");
	}

	public function del_prod()
	{
		if(isset($_GET["delete"]) && isset($_GET["confirm"]))
		{
			$query = "DELETE FROM products WHERE id = ?";
			$variable = array($_GET["delete"]);
			$SQL = new Query($query, $variable);
			$SQL->SQLquery();
		}
		$this->show_prod('admin.php?action=del_prod&delete=');
	}


	private function show_prod($redirection = NULL)
	{
		$query = "SELECT products.id, products.name, products.price, categories.name AS categories FROM products INNER JOIN categories ON products.category_id = categories.id";
		$SQL = new Query($query);
		$products = $SQL->SQLquery();
		echo '<ul>';
		foreach ($products as $key => $value)
		{
			echo'<li><a href='.$redirection.$value["id"].' >'.$value["name"].'</a></li>';
			if(isset($_GET["delete"]) && $_GET["delete"] == $value["id"])
			{
				new Form(array(), "Confirm",$redirection.$value["id"].'&confirm=1');
			}
		}
		echo '</ul>';
	}


	public function mod_prod()
	{
		if(isset($_POST["name"]))
		{
			$query = "SELECT id FROM products WHERE id = ?";
			$variable = array($_GET["mod"]);
			$SQL = new Query($query, $variable);
			$product = $SQL->SQLquery();

			$query = "SELECT id FROM categories WHERE name = ?";
			$variable = array($_POST["category_name"]);
			$SQL = new Query($query,$variable);
			$category_id = $SQL->SQLquery();
			if(isset($category_id) && isset($product))
			{
				$query = "UPDATE products SET name = ?, price = ?, category_id = ? WHERE id = ?";
				$variable = array($_POST["name"],$_POST["price"],$category_id[0]["id"], $product[0]["id"]);
				$SQL = new Query($query,$variable);
				$SQL->SQLquery();
				echo "Product modified";
			}
		}
		if(isset($_GET["mod"]))
		{
			$mod_prod["name"] = "Product name: ";
			$mod_prod["price"] = "Product Price (€): ";
			$mod_prod["category_name"] = "Category: ";
			new form($mod_prod, "Apply modification");
		}
		$this->show_prod('admin.php?action=mod_prod&mod=');
	}


	public function display_prod()
	{
		if(isset($_GET["display"]))
		{
			$query = "SELECT * FROM products WHERE id = ?";
			$variable = array($_GET["display"]);
			$SQL = new Query($query, $variable);
			$product = $SQL->SQLquery()[0];
			$product = new Product($product);
			echo "ID =  ".$product->getId()." Name = ".$product->getName()." Price = ".$product->getPrice()." Cat_ID = ".$product->getCategory_id()." Cat_Name = ".$product->getCategory_name();
			foreach ($product as $key => $value)
			{
				echo $key." : ".$value."<br>";
			}
		}
		$this->show_prod('admin.php?action=display_prod&display=');
	}
}
?>
