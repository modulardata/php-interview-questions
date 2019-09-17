<?php /* Smarty version 2.6.11, created on 2012-12-06 18:05:51
         compiled from modules/Emails/templates/addressSearchContent.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'modules/Emails/templates/addressSearchContent.tpl', 55, false),)), $this); ?>
<div id="contactsDialogue"></div>
<div id="contactsDialogueHTML" class="yui-hidden">
	<div id="contactsDialogueBody">
		<div id='addressBookTabsDiv'></div>
		<div id='contactsSearchTabs'>
		  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/addressSearch.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		
        <table >
        <tr>
            <td width="60%">
                <div id="addrSearchGrid" ></div>
	           <div id='dt-pag-nav-addressbook'></div>
	        </td>
	        <td width="3%">
	           <span style="position:relative; top:1px;">&nbsp;
	               <div style="overflow: visible; height: 0; position: absolute; width: 0; right:-2em; top:-166px;">
	                   <h3 style=""><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SELECTED_ADDR','module' => 'Emails'), $this);?>
:</h3>
	               </div>
	           </span>
	        </td>
	        <td width="37%"valign="top">
	           <div id="addrSearchResultGrid"></div>
	           <div class="yui-pg-container">&nbsp;</div>
	         </td>
        </tr>
        </table>
	    
    </div>
</div>