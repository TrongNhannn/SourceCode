<?php
/**
 * @package		A-Z Directory
 * @subpackage	mod_azdirectory
 * @copyright	Copyright (C) 2016 Bmore Creative, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @website		https://www.bmorecreativeinc.com/joomla/extensions
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
define( 'MODAZPATH', 'modules/mod_azdirectory/assets/' );

use Joomla\CMS\Factory;
use Joomla\CMS\Filter\InputFilter;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\User\User;
use Joomla\Registry\Registry;

class modAZDirectoryHelper
{
	private $params = null;
	private static $_azInstance = null;
	
	public static function azInstance( &$params, $type )
	{
		if( null == self::$_azInstance || empty( $_azInstance[$type] ) ) :
			self::$_azInstance[$type] = new self( $params );
		endif;
	
		return self::$_azInstance[$type];
	}

	public function __construct( &$params )
	{
		mb_internal_encoding( 'utf-8' ); // @important
		$this->params = $params;
	}

    /**
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */
	 
	// get module parameters
    public function getAZDirectory()
    {
		$doc = Factory::getDocument();
		
		$nameHyperlink = $this->params->get( 'name_hyperlink' );

		if( $nameHyperlink == 1 ) :
			// load standard Bootstrap and custom Bootstrap styles
			HTMLHelper::_( 'bootstrap.framework' );
			$doc->addStyleSheet( MODAZPATH . 'modazbootstrap.css' );
		endif;
		
		// set a flag whether to load azModal JS
		$doc->addScriptDeclaration( 'var modazNameHyperlink=' . $nameHyperlink . ';' );
		
		// pass value for JALL language constant to Javascript
		Text::script( 'JALL' );

		// load standard assets
		$doc->addStyleSheet( MODAZPATH . 'modazdirectory.css' );

		$loadJS = $this->params->get( 'loadjs' );
		if( $loadJS == 1 ) :
			$doc->addScript( MODAZPATH . 'modazdirectory.js' );
		else :
			$doc->addScript( MODAZPATH . 'modazformsubmit.js' );
		endif;

		// get sort order
		$sortorder = $this->params->get( 'sortorder' );
		
		// published for bind statement
		$published = 1;

		// access control
		$user = Factory::getUser();
		$authorised = $user->getAuthorisedViewLevels();

		// access database object
		$db = Factory::getDbo();

		// // Define null and now dates
		$nullDate = $db->quote( $db->getNullDate() );
		$nowDate = $db->quote( Factory::getDate()->toSql() );

		// initialize query
		// whereIn will automatically use the values and add prepared statements
		$query = $db->getQuery( true )
					->select( $db->quoteName( 'name' ) . " AS name" )
					->from( $db->quoteName( '#__contact_details', 'a' ) );
		
		$catid = $this->params->get( 'id' );
		if( !empty( $catid[0] ) ) :
			$query->whereIn( $db->quoteName( 'a.catid' ), $catid );
		endif;
	
		$tagid = (array)$this->params->get( 'tags' );
		if( !empty( $tagid[0] ) ) :
			$query
				->join( 'LEFT', $db->quoteName( '#__contentitem_tag_map', 'b' ) . ' ON (' . $db->quoteName( 'a.id' ) . ' = ' . $db->quoteName( 'b.content_item_id' ) . ')' )
				->where( $db->quoteName( 'b.type_alias' ) . ' = ' . $db->quote( 'com_contact.contact' ) )
				->whereIn( $db->quoteName( 'b.tag_id' ), $tagid );
		endif;
		
		$query
			->whereIn( $db->quoteName( 'a.access' ), $authorised )
			->where( $db->quoteName( 'a.published' ) . ' = :published' )
			->andWhere(
				[
					$db->quoteName( 'a.publish_up' ) . ' = ' . $nullDate,
					$db->quoteName( 'a.publish_up' ) . ' IS NULL',
					$db->quoteName( 'a.publish_up' ) . ' <= ' . $nowDate
				]
			)
			->andWhere(
				[
					$db->quoteName( 'a.publish_down' ) . ' = ' . $nullDate,
					$db->quoteName( 'a.publish_down' ) . ' IS NULL',
					$db->quoteName( 'a.publish_down' ) . ' >= ' . $nowDate
				]
			)
			->order( $db->quoteName( 'a.name' ) )
			->bind( ':published', $published );
				
		$db->setQuery( $query );
		$rows = $db->loadAssocList( 'name' );
		$names = array_keys( $rows );
	
		$letters = $alphabets = array();
		
		foreach( $names as $key => $name ):
			if( $sortorder == 'ln' ) :
				$parser = new FullNameParser();
				$words = $parser->parse_name( $name );
				$letters[] = mb_substr( $words['lname'], 0, 1, "utf8" );
			else: 
				$letters[] = mb_substr( $name, 0, 1, "utf8" );
			endif;
		endforeach;
		
		$alphabet = $this->params->get( 'swedish' );
		
		// if no Language is selected, default to English (0)
		if( empty( $alphabet ) ){
			$alphabet = array( 0 );
			$this->params->set( 'swedish', $alphabet );
		}
		
		// if more than 1 alphabet is selected
		if( sizeof( $alphabet ) > 1 ):
			// return the first/last letters based on fn/ln sortorder
			$letters = array_unique( $letters );
			
			foreach( $letters as $letter ){
				
				// get the unicode values
				$unicode = dechex( mb_ord( $letter ) );
				
				// ensure the unicode values are 4 digits by prepending zeroes
				$unicode = AZDirectoryHelper::_azStrPadUnicode( $unicode, 4, '0', STR_PAD_LEFT );
				
				// add them into Latin or Cyrillic arrays
				if( ( $unicode >= '0041' ) && ( $unicode <= '024f' ) )
					$alphabets['Latin'][] = $letter;
				elseif( ( $unicode >= '0400' ) && ($unicode <= '04ff' ) )
					$alphabets['Cyrillic'][] = $letter;
			}
			
			// sort them alphabetically
			if( array_key_exists( 'Latin', $alphabets ) && sizeof( $alphabets['Latin'] ) > 0 ):
				sort( $alphabets['Latin'], SORT_LOCALE_STRING );
			endif;

			if( array_key_exists( 'Cyrillic', $alphabets ) && sizeof( $alphabets['Cyrillic'] ) > 0 ):
				sort( $alphabets['Cyrillic'], SORT_LOCALE_STRING );
			endif;

		else:
			// 1 alphabet is selected
			// convert alphabet array to a string
			$alphabet = array_shift( $alphabet );
			
			$english = range( "A", "Z" );
			
			$swedish = array( "Å", "Ä", "Ö" );
			
			$cyrillic = array(
				"А", "Б", "В", "Г", "Д", "Е", "Ё",
				"Ж", "З", "И", "Й", "К", "Л", "М",
				"Н", "О", "П", "Р", "С", "Т", "У",
				"Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ",
				"Ы", "Ь", "Э", "Ю", "Я"
			);
			
			$czech = array(
				"A", "Á", "B", "C", "Č", "D", "Ď",
				"E", "É", "Ě", "F", "G", "H", "Ch",
				"I", "Í", "J", "K", "L", "M", "N",
				"Ň", "O", "Ó", "P", "Q", "R", "Ř",
				"S", "Š", "T", "Ť", "U", "Ú", "Ů",
				"V", "W", "X", "Y", "Ý", "Z", "Ž" 
			);
		
			switch( $alphabet ):
				case 1:
					$alphabets['Latin'] = array_merge( $english, $swedish );
					break;
				case 2:
					$alphabets['Cyrillic'] = $cyrillic;
					break;
				case 3:
					$alphabets['Latin'] = $czech;
					break;
				default:
					$alphabets['Latin'] = $english;
			endswitch;
		endif;
		
		$tmpl = array();
		$tmpl[0] = $alphabets;
		$tmpl[1] = array_unique( $letters );
		
		return $tmpl;
    }

	/**
	 * Method to get contact information based on first letter of last name
	 *
	 * @access    public
	 */
	public static function getContactsAjax()
	{
		$app = Factory::getApplication();
		
		// get the data
		$azdata = $app->input->getString( 'data' );
		$lastletter = filter_var( $azdata['letter'], FILTER_SANITIZE_STRING );
		$start = filter_var( $azdata['start'], FILTER_SANITIZE_NUMBER_INT );
		$title = filter_var( $azdata['title'], FILTER_SANITIZE_STRING );
		
		// get module parameters
		$module = ModuleHelper::getModule( 'azdirectory', $title );
		$params = new Registry( $module->params );
		
		$az = self::azInstance( $params, $module->id );
		$modAZAssetsPath = Uri::base() . 'modules/' . $module->module . '/assets/';
		
		// get the contacts
		list( $contacts, $total, $start ) = $az->azGenerateQuery( $lastletter, $start, $params );
		
		// get parameters specific to the module configuration
		// e.g. $show_image = $params->get('show_image');
		// NOTE: id (category IDs) is an array, so a variable is not created and not used in default.php
		foreach ( $params as $key => $value ):
			if( is_string( $value ) ) :
				$$key = htmlspecialchars( $value );
			endif;
		endforeach;
		
		$azdirectory = $az->getAZDirectory();
		
		ob_clean();
		ob_start();
		
		// checks for layout override first, then checks for original
		require_once ModuleHelper::getLayoutPath( 'mod_azdirectory', $params->get( 'layout', 'default' ) );

		ob_get_contents();

		exit;
		$app->close();
	}

	/**
	 * Method to verify valid user data
	 *
	 * @access    public
	 */
	public function azVerify( $key, $values ){
		$param = $this->params->get( 'show_' . $key );
		$value = $values->$key;
		return ( ( $param == 1 ) && ( $value ) ) ? 1 : 0;
	}
	
	/**
	 * Method to redirect page based on select
	 *
	 * @access    public
	 */	
	 public static function submit( $azoption ){
		header( 'Location: ' . $azoption );		 
	 }

	/**
	 * Method to format name
	 *
	 * @access    public
	 */	
	public static function azFormatName( $name, $lastnameFirst ){
		if( $lastnameFirst == 1 ) :
			$parser = new FullNameParser();
			$words = $parser->parse_name( $name );
			$lastname = $words['lname'];
			$firstname = $words['fname'];
			$name = $lastname . ", " . $firstname;
		endif;
		return $name;
	}
	
	/**
	 * Method to sanitize telephone numbers
	 *
	 * @access    public
	 */
	public static function azSanitizeTelephone( $telephone ){
		return str_replace( array( "+", "-" ), "", filter_var( $telephone, FILTER_SANITIZE_NUMBER_INT ) );
	}
	
	/**
	 * Method to sanitize URLs
	 *
	 * @access    public
	 */
	public static function azSanitizeURL( $url ){
		$filter = InputFilter::getInstance();
		return $filter->clean( $url, "string" );
	}

	/**
	 * Method to get category title from ID
	 *
	 * @access    public
	 */
	public static function azCategory( $catid ){
		// access database object
		$db = Factory::getDBo();

		// initialize query
		$query = $db->getQuery( true )
					->select( $db->quoteName( 'title' ) )
					->from( $db->quoteName( '#__categories' ) )
					->where( $db->quoteName( 'id' ) . ' = :catid' )
					->bind( ':catid', $catid );
				
		$db->setQuery( $query );
		
		return $db->loadResult();
	}
	
	/**
	 * Method to format addresses
	 *
	 * @access    public
	 */	
	public function azFormatAddress( $contact, $postcodeFirst )
	{
		if ( $this->azVerify( 'suburb', $contact ) || $this->azVerify( 'state', $contact ) || $this->azVerify( 'postcode', $contact ) ) :
			
			$lines = array();
			
			if ( $postcodeFirst == 1 ) :
				// international address format
				$line = array();
				if ( $this->azVerify( 'postcode', $contact ) ) $line[] = '<span>' . $contact->postcode . '</span>';
				if ( $this->azVerify( 'suburb', $contact ) ) $line[] = '<span>' . $contact->suburb . '</span>';
				if ( $this->azVerify( 'state', $contact ) ) $line[] = '<span>' . $contact->state . '</span>';
				$lines[] = implode( ' ', $line );
			else :
				// US address format
				$line = array();
				if ( $this->azVerify( 'suburb', $contact ) ) $line[] = '<span>' . $contact->suburb . '</span>';
				if ( $this->azVerify( 'state', $contact ) ) $line[] = '<span>' . $contact->state . '</span>';
				if ( count( $line ) ) $line = array( implode( ', ', $line ) );
				if ( $this->azVerify( 'postcode', $contact ) ) $line[] = '<span>' . $contact->postcode . '</span>';
				$lines[] = implode( ' ', $line );	
			endif;
		
			return $lines[0];
		
		endif;
		
		return "";
	}

	/**
	 * Method to get the default option for the select option
	 *
	 * @access    public
	 */	
	public static function azFirstOption( $sortorder )
	{
		$language = Factory::getLanguage();
		$language->load( 'mod_azdirectory' );

		if ( $sortorder == 'ln' ) :
			$modazfirstoption = Text::_( 'MOD_AZDIRECTORY_SORTORDER_LN' );
		else :
			$modazfirstoption = Text::_( 'MOD_AZDIRECTORY_SORTORDER_FN' );
		endif;

		return $modazfirstoption;
	}

	/**
	 * Method to generate SQL query
	 *
	 * @access    public
	 */
	public static function azGenerateQuery( $letter, $start, $params )
	{
		require_once dirname(__FILE__) . '/helpers/parser.php';

		// get category id
		$catid = $params->get( 'id' );
		
		// get the tags
		$tagid = $params->get( 'tags' );
		
		// get the sort order
		$sortorder = $params->get( 'sortorder' );
		
		// get the pagination setting
		$pagination = $params->get( 'pagination' );
		
		// get the alphabet
		$alphabet = $params->get( 'swedish' );

		// published for bind statement
		$published = 1;
		
		// access control
		$user = Factory::getUser();
		$authorised = $user->getAuthorisedViewLevels();

		// access database object
		$db = Factory::getDBo();
		
		// // Define null and now dates
		$nullDate = $db->quote( $db->getNullDate() );
		$nowDate = $db->quote( Factory::getDate()->toSql() );

		// initialize query
		// whereIn will automatically use the values and add prepared statements
		$query = $db->getQuery( true )
					->select( array('*') )
					->from( $db->quoteName( '#__contact_details', 'a' ) );
		
		if( !empty( $catid[0] ) ) :
			$query->whereIn( $db->quoteName( 'a.catid' ), $catid );
		endif;
		
		if( !empty( $tagid[0] ) ) :
			$query
				->join( 'LEFT', $db->quoteName( '#__contentitem_tag_map', 'b' ) . ' ON (' . $db->quoteName( 'a.id' ) . ' = ' . $db->quoteName( 'b.content_item_id' ) . ')' )
				->where( $db->quoteName( 'b.type_alias' ) . ' = ' . $db->quote( 'com_contact.contact' ) )
				->whereIn( $db->quoteName( 'b.tag_id' ), $tagid );
		endif;

		$query
			->whereIn( $db->quoteName( 'a.access' ), $authorised )
			->where( $db->quoteName( 'a.published' ) . ' = :published' )
			->andWhere(
				[
					$db->quoteName( 'a.publish_up' ) . ' = ' . $nullDate,
					$db->quoteName( 'a.publish_up' ) . ' IS NULL',
					$db->quoteName( 'a.publish_up' ) . ' <= ' . $nowDate
				]
			)
			->andWhere(
				[
					$db->quoteName( 'a.publish_down' ) . ' = ' . $nullDate,
					$db->quoteName( 'a.publish_down' ) . ' IS NULL',
					$db->quoteName( 'a.publish_down' ) . ' >= ' . $nowDate
				]
			)
			->bind( ':published', $published );
				
		$db->setQuery( $query );

		$result = $db->loadObjectList();

		foreach( $result as $record ):
			
			// add the targeted letter to each object
			$name = $record->name;
			
			if( $sortorder == 'ln' ) :
				$parser = new FullNameParser();
				$words = $parser->parse_name( $name );
				$record->letter = mb_substr( $words['lname'], 0, 1, "utf8" );
				$record->ln = $words['lname'];
			else: 
				$record->letter = mb_substr( $name, 0, 1, "utf8" );
			endif;

			// add the category name to each object
			$record->catname = modAZDirectoryHelper::azCategory( $record->catid );
			
			// add custom fields to each object
			$record->customfields = modAZDirectoryHelper::azCustomFields( $record->id );

		endforeach;
		
		// remove objects where the selected letter is not the targeted letter
		if( $letter != Text::_( 'JALL' ) ) :
			$result = array_filter( $result, function( $a ) use ( $letter ){
				return $a->letter === $letter;
			});
		endif;
		
		$locale = 'en_US.UTF-8';
		if( in_array( 1, $alphabet ) ) $locale = 'sv_SE.UTF-8';
		if( in_array( 3, $alphabet ) ) $locale = 'cs_CZ.UTF-8';
		setlocale( LC_ALL, $locale );
		
		usort( $result, function( $a, $b ) use ( $sortorder ){
			switch( $sortorder ) :
				case 'fn' :
					return strcoll( $a->name, $b->name );
					break;
				case 'ln' :
					return strcoll( $a->ln, $b->ln );
					break;
				case 'sortfield' :
					return strcmp( $a->sortname1, $b->sortname1 );
					break;
				case 'component' :
					return strnatcmp( $a->ordering, $b->ordering );
					break;
				default :
					return strcoll( $a->ln, $b->ln );
			endswitch;
		});

		// get the true number of array entries
		$total_rows = sizeof( $result );

		// pagination if not All
		if( $pagination !== 'All' ) :
			$result = array_slice( $result, $start, $pagination );
		endif;
		
		return array( $result, $total_rows, $start );
	}
	
	/**
	 * Method to get custom fields
	 *
	 * @access    public
	 */
	public static function azCustomFields( $id )
	{
		JLoader::register( 'FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php' );
		// get custom fields by contact ID
		$azCustomFields = FieldsHelper::getFields( 'com_contact.contact', $id, true );
		// get custom field names
		$azCustomFieldNames = array_map( function( $o ){ return $o->title; }, $azCustomFields );
		// get custom field IDs
		$azCustomFieldIDs = array_map( function( $o ){ return $o->id; }, $azCustomFields );
		// load fields model
		JModelLegacy::addIncludePath( JPATH_ADMINISTRATOR . '/components/com_fields/models', 'FieldsModel' );
		$azModel = JModelLegacy::getInstance( 'Field', 'FieldsModel', array( 'ignore_request' => true ) );
		// fetch values for custom field IDs
		$azCustomFieldValues = $azModel->getFieldValues( $azCustomFieldIDs, $id );
		// create an array of field IDs as keys and field values as values
		$azMap = array_combine( $azCustomFieldIDs, $azCustomFieldNames );	
		// eliminate array entries with empty values
		$azIntersect = array_intersect_key( $azMap, $azCustomFieldValues );
		// create an array setting the value of azIntersect as the keys of azCustomFieldValues
		$azCombine = array();
		foreach( $azIntersect as $key => $column ) :
			$azCombine[$column] = $azCustomFieldValues[$key];
		endforeach;
		
		return $azCombine;
	}

	private static function _azStrPadUnicode( $str, $pad_len, $pad_str = ' ', $dir = STR_PAD_RIGHT )
	{
		$str_len = mb_strlen( $str );
		$pad_str_len = mb_strlen( $pad_str );
		if( !$str_len && ( $dir == STR_PAD_RIGHT || $dir == STR_PAD_LEFT ) ){
			$str_len = 1; // @debug
		}
		if( !$pad_len || !$pad_str_len || $pad_len <= $str_len ){
			return $str;
		}
	   
		$result = null;
		$repeat = ceil( $str_len - $pad_str_len + $pad_len );
		if( $dir == STR_PAD_RIGHT ){
			$result = $str . str_repeat( $pad_str, $repeat );
			$result = mb_substr( $result, 0, $pad_len );
		} else if( $dir == STR_PAD_LEFT ){
			$result = str_repeat( $pad_str, $repeat ) . $str;
			$result = mb_substr( $result, -$pad_len );
		} else if( $dir == STR_PAD_BOTH ){
			$length = ( $pad_len - $str_len ) / 2;
			$repeat = ceil( $length / $pad_str_len );
			$result = mb_substr( str_repeat( $pad_str, $repeat ), 0, floor( $length ) )
						. $str
						   . mb_substr( str_repeat( $pad_str, $repeat ), 0, ceil( $length ) );
		}
	   
		return $result;
	}	
}