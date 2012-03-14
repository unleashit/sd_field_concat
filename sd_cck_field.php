<?php
// No Direct Access
defined( '_JEXEC' ) or die;

// Plugin Class
class plgCCK_Field_LiveSd_Cck_Field extends JCckPluginLive{
	
	protected static $type	=	'sd_cck_field';
	
	// -------- -------- -------- -------- -------- -------- -------- -------- // Prepare
		
	// onCCK_Field_LivePrepareForm
	public function onCCK_Field_LivePrepareForm( &$field, &$value = '', &$config = array() )
	{			
		
		 //If for some reason the type of live does not match ours and is using this script, kill it
		if ( self::$type !== $field->live) {
			return;
		}
		
		// Define a variabel. Yawn.
		$live = '';
		
		// Get the live value and do some magic... Not much to it really.
		if ( $field->live_value ) {
			
			// Get the live values, in our case the CCK field to clone
			$SdFieldValue = trim($field->live_value);			
			$id_content = JRequest::getInt( 'id', '' );
			$field_storage = JCckDatabase::loadObject( 'SELECT a.storage_field, a.storage_table FROM #__cck_core_fields AS a WHERE a.name = "'.$SdFieldValue.'"' );
			$live = JCckDatabase::loadResult( 'SELECT '.$field_storage->storage_field.' FROM '.$field_storage->storage_table.' AS a WHERE a.id = "'.$id_content.'"');
			$value = (($live !== NULL && $live > '') ? $live : NULL);

		}
		
	}
}

?>