<?php
/**
 * Created by Symphony Extension Developer.
 * Part of 'Published Checkbox' extension.
 * 2013-03-04
 */

if (!defined('__IN_SYMPHONY__')) die('<h2>Symphony Error</h2><p>You cannot directly access this file</p>');

require_once(TOOLKIT.'/fields/field.checkbox.php');

Class FieldPublish_Checkbox extends FieldCheckbox {
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->_name = __('Publish Checkbox');
	}

	/**
	 * Output:
	 * @param XMLElement $wrapper
	 * @param array $data
	 * @param bool $encode
	 * @param null $mode
	 * @param null $entry_id
	 */
	public function appendFormattedElement(XMLElement &$wrapper, $data, $encode = false, $mode = null, $entry_id = null) {
		// If the administrator is logged in, always return yes:
		if(Symphony::Engine()->isLoggedIn()) { $data['value'] = 'yes'; }
		parent::appendFormattedElement($wrapper, $data, $encode, $mode, $entry_id);
	}

	/**
	 * Filtering:
	 * @param array $data
	 * @param string $joins
	 * @param string $where
	 * @param bool $andOperation
	 * @return bool|void
	 */
	public function buildDSRetrievalSQL($data, &$joins, &$where, $andOperation = false) {
		// If the administrator is logged in, always do it:
		if(Symphony::Engine()->isLoggedIn()) {
			parent::buildDSRetrievalSQL(array('yes', 'no'), $joins, $where, $andOperation);
		} else {
			return parent::buildDSRetrievalSQL($data, $joins, $where, $andOperation);
		}
	}

}
