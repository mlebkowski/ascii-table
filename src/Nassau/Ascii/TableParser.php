<?php

namespace Nassau\Ascii;

class TableParser 
{

	const STATE_KEYS = 'keys';
	const STATE_VALUES = 'values';
	
	protected $state = self::STATE_KEYS;

	protected $keys = array ();
	protected $values = array ();
	
	/**
	 * @param string text to parse
	 *
	 * @return array
	 **/
	 
	public function parse($string) 
	{
		$this->state = self::STATE_KEYS;
		$this->values = $this->keys = array ();
		
		$lines = explode("\n", $string);
		foreach ($lines as $line) 
		{
			$line = chop($line);
			
			$this->parseLine($line);
		}
		return $this->values;
	}
	
	protected function parseLine($line)
	{
		if (preg_match('/^(\s*#|([+]?-+)+[+]?$)/', $line) || empty($line)) 
		{
			return;
		}
		
		$line = trim($line, ' |');
		$items = explode("|", $line);
		$items = array_map('trim', $items);
		
		if (self::STATE_KEYS === $this->state)
		{
			$this->state = self::STATE_VALUES;
			$this->keys = $items;
		}
		else 
		{
			$this->values[] = array_combine($this->keys, $items);
		}
		
	}
}
