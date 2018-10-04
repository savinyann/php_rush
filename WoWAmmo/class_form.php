<?php
class Form
{
	public function __construct($array = array(), $submit, $action = NULL)
	{

		echo '<form action="'.$action.'" method="post">';
		foreach ($array as $key => $value)
		{
/*			if(substr($key,0,3) == "int" && substr($key,-2,2) != "id")
			{
				$key_min = $key."_min";
				$key_max = $key."_max";
				echo '<label for='.$key_min.'>'.$value.' min: </label>
				<input type="number" class="form-control" name='.$key_min.' id='.$key_min.' />';
				echo '<label for='.$key_max.'>'.$value.' max: </label>
				<input type="number" class="form-control" name='.$key_max.' id='.$key_max.' />';

			}
			else*/if($key == "password" || $key == "password_conf")
			{
				echo '<label for='.$key.'>'.$value.'</label><input type="password" class="form-control" name='.$key.' id='.$key.' /></p>';
			}
			else
			{
				echo '<label for='.$key.'>'.$value.'</label><input type="text" class="form-control" name='.$key.' id='.$key.' />';
			}
		}
		echo '<div><button class="btn btn-lg btn-primary btn-block" type="submit">'.$submit.'</button></div></form>';
	}
}
?>
