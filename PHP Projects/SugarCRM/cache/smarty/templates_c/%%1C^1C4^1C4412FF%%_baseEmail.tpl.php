<?php /* Smarty version 2.6.11, created on 2012-12-06 18:05:51
         compiled from modules/Emails/templates/_baseEmail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getjspath', 'modules/Emails/templates/_baseEmail.tpl', 38, false),)), $this); ?>
<link rel="stylesheet" type="text/css" href="<?php echo smarty_function_sugar_getjspath(array('file' => 'modules/Emails/EmailUI.css'), $this);?>
" />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/_baseJsVars.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript" src='<?php echo smarty_function_sugar_getjspath(array('file' => 'include/javascript/tiny_mce/tiny_mce.js'), $this);?>
'></script>
<script type="text/javascript" src='<?php echo smarty_function_sugar_getjspath(array('file' => 'cache/include/javascript/sugar_grp_emails.js'), $this);?>
'></script>
<script type="text/javascript" src='<?php echo smarty_function_sugar_getjspath(array('file' => 'cache/include/javascript/sugar_grp_yui_widgets.js'), $this);?>
'></script>
<script type="text/javascript" src="include/javascript/jsclass_base.js"></script>
<script type="text/javascript" src="include/javascript/jsclass_async.js"></script>

<script type="text/javascript" language="Javascript">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/_baseConfigData.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    var calFormat = '<?php echo $this->_tpl_vars['calFormat']; ?>
';
    var theme = "<?php echo $this->_tpl_vars['theme']; ?>
";

    <?php echo $this->_tpl_vars['quickSearchForAssignedUser']; ?>


    SUGAR.email2.detailView.qcmodules = <?php echo $this->_tpl_vars['qcModules']; ?>
;


    var isAdmin = <?php echo $this->_tpl_vars['is_admin']; ?>
;
    var loadingSprite = app_strings.LBL_EMAIL_LOADING + " <img src='include/javascript/yui/build/assets/skins/sam/wait.gif' alt=$mod_strings.LBL_WAIT height='14' align='absmiddle'>";
</script>
<div class="email">
<form id="emailUIForm" name="emailUIForm">
    <input type="hidden" id="module" name="module" value="Emails">
    <input type="hidden" id="action" name="action" value="EmailUIAjax">
    <input type="hidden" id="to_pdf" name="to_pdf" value="true">
    <input type="hidden" id="emailUIAction" name="emailUIAction">
    <input type="hidden" id="mbox" name="mbox">
    <input type="hidden" id="uid" name="uid">
    <input type="hidden" id="ieId" name="ieId">
    <input type="hidden" id="forceRefresh" name="forceRefresh">
    <input type="hidden" id="focusFolder" name="focusFolder">
    <input type="hidden" id="focusFolderOpen" name="focusFolderOpen">
    <input type="hidden" id="sortBy" name="sortBy">
    <input type="hidden" id="reverse" name="reverse">
</form>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000;"></div>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td NOWRAP style="padding-bottom: 2px;">
            <button class="button" id="checkEmailButton" onclick="SUGAR.email2.folders.startEmailAccountCheck();"><img src="themes/default/images/icon_email_check.gif" alt=$mod_strings.LBL_CHECKEMAIL align="absmiddle" border="0"> <?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_CHECK']; ?>
</button>
            <button class="button" id="composeButton" onclick="SUGAR.email2.composeLayout.c0_composeNewEmail();"><img src="themes/default/images/icon_email_compose.gif" alt=$mod_strings.LBL_COMPOSEEMAIL align="absmiddle" border="0"> <?php echo $this->_tpl_vars['mod_strings']['LNK_NEW_SEND_EMAIL']; ?>
</button>
            <button class="button" id="settingsButton" onclick="SUGAR.email2.settings.showSettings();"><img src="themes/default/images/icon_email_settings.gif" alt=$mod_strings.LBL_EMAILSETTINGS align="absmiddle" border="0"> <?php echo $this->_tpl_vars['app_strings']['LBL_EMAIL_SETTINGS']; ?>
</button>
        </td>
        <td NOWRAP align="right" style="padding-bottom: 2px;">
            <a href="index.php?module=Administration&action=SupportPortal&view=documentation&version=<?php echo $this->_tpl_vars['sugar_version']; ?>
&edition=<?php echo $this->_tpl_vars['sugar_flavor']; ?>
&lang=<?php echo $this->_tpl_vars['current_language']; ?>
&help_module=Emails&help_action=index&key=<?php echo $this->_tpl_vars['server_unique_key']; ?>
" width='13' height='13' alt='<?php echo $this->_tpl_vars['app_strings']['LNK_HELP']; ?>
' border='0' align='absmiddle' target="_blank"></a>
            &nbsp;
            <a href="index.php?module=Administration&action=SupportPortal&view=documentation&version=<?php echo $this->_tpl_vars['sugar_version']; ?>
&edition=<?php echo $this->_tpl_vars['sugar_flavor']; ?>
&lang=<?php echo $this->_tpl_vars['current_language']; ?>
&help_module=Emails&help_action=index&key=<?php echo $this->_tpl_vars['server_unique_key']; ?>
" class='utilsLink' target="_blank"><?php echo $this->_tpl_vars['app_strings']['LNK_HELP']; ?>
</a>
        </td>
    </tr>
</table>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/overlay.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="emailContextMenu"></div>
<div id="folderContextMenu"></div>
<div id="container" class="email" style="position:relative; height:550px; overflow:hidden;"></div>
<div id="innerLayout" class="yui-hidden"></div>
<div id="listViewLayout" class="yui-hidden"></div>
<div id="settingsDialog"></div>

<!-- Hidden Content -->
<div class="yui-hidden">
    <div id="searchTab" style="padding:5px">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/advancedSearch.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
    <div id="settings">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/emailSettings.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

    <div id="footerLinks" class="yui-hidden"></div>
</div>


<div id="editContact" class="yui-hidden"></div>
<div id="editContactTab" class="yui-hidden"></div>
<div id="editMailingList" class="yui-hidden"></div>
<div id="editMailingListTab" class="yui-hidden"></div>


<!-- for detailView quickCreate() calls -->
<div id="quickCreateForEmail"></div>
<div id="quickCreateContent"></div>


<div id="importDialog"></div>
<div id="importDialogContent" ></div>


<div id="relateDialog"  ></div>
<div id="relateDialogContent"  ></div>


<div id="assignmentDialog"  ></div>
<div id="assignmentDialogContent"  ></div>


<div id="emailDetailDialog"  ></div>
<div id="emailDetailDialogContent"  ></div>


<!-- for detailView views -->
<div id="viewDialog"></div>
<div id="viewDialogContent"></div>

<!-- addressBook select -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/addressSearchContent.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!-- accounts outbound server dialogue -->
<div id="outboundDialog" class="yui-hidden">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/outboundDialog.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<!-- accounts edit dialogue -->
<div id="editAccountDialogue" class="yui-hidden">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/editAccountDialogue.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<div id="testOutboundDialog" class="yui-hidden">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/outboundDialogTest.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<div id="assignToDiv" class="yui-hidden">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/Emails/templates/assignTo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>


<script type="text/javascript" language="Javascript">
	enableQS(true);
</script>

</div>