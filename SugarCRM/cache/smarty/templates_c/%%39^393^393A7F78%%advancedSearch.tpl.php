<?php /* Smarty version 2.6.11, created on 2012-12-06 18:05:51
         compiled from modules/Emails/templates/advancedSearch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getimage', 'modules/Emails/templates/advancedSearch.tpl', 67, false),array('function', 'sugar_translate', 'modules/Emails/templates/advancedSearch.tpl', 81, false),array('function', 'sugar_getimagepath', 'modules/Emails/templates/advancedSearch.tpl', 86, false),array('function', 'html_options', 'modules/Emails/templates/advancedSearch.tpl', 93, false),)), $this); ?>
<form name="advancedSearchForm" id="advancedSearchForm">
<table cellpadding="4" cellspacing="0" border="0" id='advancedSearchTable'>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td class="advancedSearchTD">
			<?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_SUBJECT']; ?>
:<br/>
			<input type="text" class="input" name="name" id="searchSubject" size="20">
		</td>
	</tr>
	<tr>
		<td class="advancedSearchTD">
			<?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_FROM']; ?>
:<br/>
			<input type="text" class="input" name="from_addr" id="searchFrom" size="20">
		</td>
	</tr>
	<tr>
		<td class="advancedSearchTD">
			<?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_TO']; ?>
:<br/>
			<input type="text" class="input" name="to_addrs" id="searchTo" size="20">
		</td>
	</tr>
    <tr class="toggleClass visible-search-option">
        <td ><a href="javascript:void(0);" onclick="SE.search.toggleAdvancedOptions();"><?php echo $this->_tpl_vars['mod_strings']['LBL_MORE_OPTIONS']; ?>
</a></td>
        <td>&nbsp;</td>
    </tr>
	<tr class="toggleClass yui-hidden">
		<td class="advancedSearchTD" style="padding-bottom: 2px">
			<?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_SEARCH_DATE_FROM']; ?>
:&nbsp;<i>(<?php echo $this->_tpl_vars['dateFormatExample']; ?>
)</i><br/>
			<input name='searchDateFrom' id='searchDateFrom' onblur="parseDate(this, '<?php echo $this->_tpl_vars['dateFormat']; ?>
');" maxlength='10' size='11' value="" type="text">&nbsp;
			<?php echo smarty_function_sugar_getimage(array('name' => 'jscalendar','ext' => ".gif",'alt' => $this->_tpl_vars['app_strings']['LBL_ENTER_DATE'],'other_attributes' => 'align="absmiddle" id="searchDateFrom_trigger" '), $this);?>

		</td>
	</tr>

	<tr class="toggleClass yui-hidden">
		<td class="advancedSearchTD">
			<?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_SEARCH_DATE_UNTIL']; ?>
:&nbsp;<i>(<?php echo $this->_tpl_vars['dateFormatExample']; ?>
)</i><br/>
			<input name='searchDateTo' id='searchDateTo' onblur="parseDate(this, '<?php echo $this->_tpl_vars['dateFormat']; ?>
');" maxlength='10' size='11' value="" type="text">&nbsp;
			<?php echo smarty_function_sugar_getimage(array('name' => 'jscalendar','ext' => ".gif",'alt' => $this->_tpl_vars['app_strings']['LBL_ENTER_DATE'],'other_attributes' => 'align="absmiddle" id="searchDateTo_trigger" '), $this);?>
		
		</td>
	</tr>

    <tr class="toggleClass yui-hidden">
        <td class="advancedSearchTD">
        <?php echo smarty_function_sugar_translate(array('label' => 'LBL_ASSIGNED_TO'), $this);?>
: <br/>
        <input name="assigned_user_name" class="sqsEnabled" tabindex="2" id="assigned_user_name" size="" value="<?php echo $this->_tpl_vars['currentUserName']; ?>
" type="text" >
        <input name="assigned_user_id" id="assigned_user_id" value="<?php echo $this->_tpl_vars['currentUserId']; ?>
" type="hidden">      
        
        <a href="javascript:void(0);">
            <img src="<?php echo smarty_function_sugar_getimagepath(array('file' => 'select.gif'), $this);?>
" align="absmiddle" border="0" alt=$mod_strings.LBL_EMAIL_SELECTOR onclick='open_popup("Users", 600, 400, "", true, false, <?php echo '{"call_back_function":"set_return","form_name":"advancedSearchForm","field_to_name_array":{"id":"assigned_user_id","name":"assigned_user_name"}}'; ?>
, "single", true);'>
        </a>
        </td>
    </tr>
      <tr class="toggleClass yui-hidden">
        <td class="advancedSearchTD">
        <?php echo $this->_tpl_vars['mod_strings']['LBL_HAS_ATTACHMENT']; ?>
<br/>
        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['attachmentsSearchOptions'],'name' => 'attachmentsSearch','id' => 'attachmentsSearch'), $this);?>
 
        </td>
    </tr>
    <tr class="toggleClass yui-hidden">
        <td NOWRAP class="advancedSearchTD">
        <?php echo $this->_tpl_vars['mod_strings']['LBL_EMAIL_RELATE']; ?>
:<br/>
        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['linkBeansOptions'],'name' => 'data_parent_type_search','id' => 'data_parent_type_search'), $this);?>

        <input id="data_parent_id_search" name="data_parent_id_search" type="hidden" value="">
        <br/><br/>
        <input class="sqsEnabled" id="data_parent_name_search" name="data_parent_name_search" type="text" value="">
        <a href="javascript:void(0);"><img src="<?php echo smarty_function_sugar_getimagepath(array('file' => 'select.gif'), $this);?>
" align="absmiddle" border="0" alt=$mod_strings.LBL_EMAIL_SELECTOR onclick="SUGAR.email2.composeLayout.callopenpopupForEmail2('_search',{'form_name':'advancedSearchForm'} );">
         </a>
        </td>
    </tr>
     <tr class="toggleClass yui-hidden">
        <td class="visible-search-option"><a href="javascript:void(0);" onclick="SE.search.toggleAdvancedOptions();"><?php echo $this->_tpl_vars['mod_strings']['LBL_LESS_OPTIONS']; ?>
</a></td>
        <td>&nbsp;</td>
    </tr>
	<tr>
		<td NOWRAP>
			<br />&nbsp;<br />
			<input type="button" id="advancedSearchButton" class="button" onclick="SUGAR.email2.search.searchAdvanced()" value="   <?php echo $this->_tpl_vars['app_strings']['LBL_SEARCH_BUTTON_LABEL']; ?>
   ">&nbsp;
			<input type="button" class="button" onclick="SUGAR.email2.search.searchClearAdvanced()" value="   <?php echo $this->_tpl_vars['app_strings']['LBL_CLEAR_BUTTON_LABEL']; ?>
   ">
		</td>
	</tr>
</table>
</form>