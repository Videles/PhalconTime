<?php
namespace PhalconTime\Forms\Elements;

use Phalcon\Forms\Element;
use Phalcon\Forms\ElementInterface;

/**
 * PhalconTime\Forms\Elements\Time
 *
 * Component INPUT[type=time] for forms
 */
class Time extends Element implements ElementInterface
{

	/**
	 * Renders the element widget returning html
	 *
	 * @param array $attributes
	 * @return string
	 */
	public function render($attributes = null)
	{
		return \Phalcon\Tag::TimeField($this->prepareAttributes($attributes));
	}
}
