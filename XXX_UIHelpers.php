<?php

abstract class XXX_UIHelpers
{
	public static function parseNativeExclusiveOptionListBoxInput ($name = '', $options = array(), $defaultIndex = 0)
	{
		$result = false;
		
		$inputValue = XXX_HTTPServer_Client_Input::getBodyVariable($name);
		
		$foundValue = false;
		
		$option = false;
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($options); $i < $iEnd; ++$i)
		{
			$option = $options[$i];
			
			$value = '';
			if (!XXX_Type::isArray($option))
			{
				$value = $option;
			}
			else if ($option['value'] != '')
			{
				$value = $option['value'];
			}
			else if ($option['ID'] != '')
			{
				$value = $option['ID'];
			}
			else if ($option['code'] != '')
			{
				$value = $option['code'];
			}
						
			if ($value == $inputValue)
			{
				$result = $option;
				
				$foundValue = true;
				
				break;
			}
		}
		
		if (!$foundValue)
		{
			if ($iEnd > 0)
			{
				$result = $options[0];
			}
		}
		
		return $result;
	}
	
	public static function composeNativeExclusiveOptionListBoxInput ($ID = '', $name = '', $options = array(), $selectedOptionValue = '')
	{
		if ($name == '')
		{
			$name = $ID;
		}
		
		$result = '';
		$result .= '<select';
		$result .= ' id="' . $ID . '"';
		$result .= ' name="' . $name . '"';
		$result .= '>';
		
		for ($i = 0, $iEnd = XXX_Array::getFirstLevelItemTotal($options); $i < $iEnd; ++$i)
		{
			$option = $options[$i];
			
			$value = '';
			if (!XXX_Type::isArray($option))
			{
				$value = $option;
			}
			else if ($option['value'] != '')
			{
				$value = $option['value'];
			}
			else if ($option['ID'] != '')
			{
				$value = $option['ID'];
			}
			else if ($option['code'] != '')
			{
				$value = $option['code'];
			}
			
			
			$selected = false;
			if (XXX_Type::isArray($option))
			{
				if ($option['value'] != '')
				{
					$selected = $selectedOptionValue == $option['value'];
				}
				if ($option['ID'] != '')
				{
					$selected = $selectedOptionValue == $option['ID'];
				}
				if ($option['code'] != '')
				{
					$selected = $selectedOptionValue == $option['code'];
				}
			}
			else if ($option == $selectedOptionValue)
			{
				$selected = true;
			}
				
			$label = '';
			if (!XXX_Type::isArray($option))
			{
				$label = $option;
			}
			else if ($option['label'] != '')
			{
				$label = $option['label'];
			}
			else if ($option['name'] != '')
			{
				$label = $option['name'];
			}
			else if ($option['code'] != '')
			{
				$label = $option['code'];
			}
			
			$result .= '<option';
			$result .= ' value="' . $value . '"';
			if ($selected)
			{
				$result .= ' selected="selected"';
			}
			
			$result .= '>';
			$result .= $label;
			
			$result .= '</option>';
		}
		
		$result .= '</select>';
		
		return $result;
	}
}

?>