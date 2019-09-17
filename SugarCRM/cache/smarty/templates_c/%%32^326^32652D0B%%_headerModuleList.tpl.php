<?php /* Smarty version 2.6.11, created on 2012-12-06 17:25:41
         compiled from themes/Sugar5/tpls/_headerModuleList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_link', 'themes/Sugar5/tpls/_headerModuleList.tpl', 71, false),)), $this); ?>
<?php if ($this->_tpl_vars['USE_GROUP_TABS']): ?>
<div id="moduleList">
<ul>
    <li class="noBorder">&nbsp;</li>
    <?php $this->assign('groupSelected', false); ?>
    <?php $_from = $this->_tpl_vars['groupTabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['groupList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['groupList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['group'] => $this->_tpl_vars['modules']):
        $this->_foreach['groupList']['iteration']++;
?>
    <?php ob_start(); ?>parentTab=<?php echo $this->_tpl_vars['group'];  $this->_smarty_vars['capture']['extraparams'] = ob_get_contents();  $this->assign('extraparams', ob_get_contents());ob_end_clean(); ?>
    <?php if (( ( $_REQUEST['parentTab'] == $this->_tpl_vars['group'] || ( ! $_REQUEST['parentTab'] && in_array ( $this->_tpl_vars['MODULE_TAB'] , $this->_tpl_vars['modules']['modules'] ) ) ) && ! $this->_tpl_vars['groupSelected'] ) || ( ($this->_foreach['groupList']['iteration']-1) == 0 && $this->_tpl_vars['defaultFirst'] )): ?>
    <li class="noBorder">
        <span class="currentTabLeft">&nbsp;</span><span class="currentTab">
            <a href="#" id="grouptab_<?php echo ($this->_foreach['groupList']['iteration']-1); ?>
"><?php echo $this->_tpl_vars['group']; ?>
</a>
        </span><span class="currentTabRight">&nbsp;</span>
        <?php $this->assign('groupSelected', true); ?>
    <?php else: ?>
    <li>
        <span class="notCurrentTabLeft">&nbsp;</span><span class="notCurrentTab">
        <a href="#" id="grouptab_<?php echo ($this->_foreach['groupList']['iteration']-1); ?>
"><?php echo $this->_tpl_vars['group']; ?>
</a>
        </span><span class="notCurrentTabRight">&nbsp;</span>
    <?php endif; ?>
    </li>
    <?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<div class="clear"></div>
<div id="subModuleList">
    <?php $this->assign('groupSelected', false); ?>
    <?php $_from = $this->_tpl_vars['groupTabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['moduleList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['moduleList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['group'] => $this->_tpl_vars['modules']):
        $this->_foreach['moduleList']['iteration']++;
?>
    <?php ob_start(); ?>parentTab=<?php echo $this->_tpl_vars['group'];  $this->_smarty_vars['capture']['extraparams'] = ob_get_contents();  $this->assign('extraparams', ob_get_contents());ob_end_clean(); ?>
    <span id="moduleLink_<?php echo ($this->_foreach['moduleList']['iteration']-1); ?>
" <?php if (( ( $_REQUEST['parentTab'] == $this->_tpl_vars['group'] || ( ! $_REQUEST['parentTab'] && in_array ( $this->_tpl_vars['MODULE_TAB'] , $this->_tpl_vars['modules']['modules'] ) ) ) && ! $this->_tpl_vars['groupSelected'] ) || ( ($this->_foreach['moduleList']['iteration']-1) == 0 && $this->_tpl_vars['defaultFirst'] )): ?>class="selected" <?php $this->assign('groupSelected', true);  endif; ?>>
    	<ul>
	        <?php $_from = $this->_tpl_vars['modules']['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['modulekey'] => $this->_tpl_vars['module']):
?>
	        <li>
	        	<?php ob_start(); ?>moduleTab_<?php echo ($this->_foreach['moduleList']['iteration']-1); ?>
_<?php echo $this->_tpl_vars['module'];  $this->_smarty_vars['capture']['moduleTabId'] = ob_get_contents();  $this->assign('moduleTabId', ob_get_contents());ob_end_clean(); ?>
	        	<?php echo smarty_function_sugar_link(array('id' => $this->_tpl_vars['moduleTabId'],'module' => $this->_tpl_vars['modulekey'],'data' => $this->_tpl_vars['module'],'extraparams' => $this->_tpl_vars['extraparams']), $this);?>

	        </li>
	        <?php endforeach; endif; unset($_from); ?>
	        <?php if (! empty ( $this->_tpl_vars['modules']['extra'] )): ?>
	        <li class="subTabMore">
	        	<a>>></a>      
		        <ul class="cssmenu">
		        <?php $_from = $this->_tpl_vars['modules']['extra']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['submodule'] => $this->_tpl_vars['submodulename']):
?>
					<li>
						<a href="<?php echo smarty_function_sugar_link(array('module' => $this->_tpl_vars['submodule'],'link_only' => 1,'extraparams' => $this->_tpl_vars['extraparams']), $this);?>
"><?php echo $this->_tpl_vars['submodulename']; ?>

						</a>
					</li>
		        <?php endforeach; endif; unset($_from); ?>
		        </ul> 
	        </li>
	        <?php endif; ?>	        
        </ul>
    </span>
    <?php endforeach; endif; unset($_from); ?>    
</div>
<?php else: ?>
<div id="moduleList">
<ul>
    <li class="noBorder">&nbsp;</li>
    <?php $_from = $this->_tpl_vars['moduleTopMenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['moduleList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['moduleList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['module']):
        $this->_foreach['moduleList']['iteration']++;
?>
    <?php if ($this->_tpl_vars['name'] == $this->_tpl_vars['MODULE_TAB']): ?>
    <li class="noBorder">
        <span class="currentTabLeft">&nbsp;</span><span class="currentTab"><?php echo smarty_function_sugar_link(array('id' => "moduleTab_".($this->_tpl_vars['name']),'module' => $this->_tpl_vars['name']), $this);?>
</span><span class="currentTabRight">&nbsp;</span>
    <?php else: ?>
    <li>
        <span class="notCurrentTabLeft">&nbsp;</span><span class="notCurrentTab"><?php echo smarty_function_sugar_link(array('id' => "moduleTab_".($this->_tpl_vars['name']),'module' => $this->_tpl_vars['name'],'data' => $this->_tpl_vars['module']), $this);?>
</span><span class="notCurrentTabRight">&nbsp;</span>
    <?php endif; ?>
    </li>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['moduleExtraMenu'] ) > 0): ?>
    <li id="moduleTabExtraMenu">
        <a href="#">&gt;&gt;</a><br />
        <ul class="cssmenu">
            <?php $_from = $this->_tpl_vars['moduleExtraMenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['moduleList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['moduleList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['module']):
        $this->_foreach['moduleList']['iteration']++;
?>
            <li><?php echo smarty_function_sugar_link(array('id' => "moduleTab_".($this->_tpl_vars['name']),'module' => $this->_tpl_vars['name'],'data' => $this->_tpl_vars['module']), $this);?>

            <?php endforeach; endif; unset($_from); ?>
        </ul>        
    </li>
    <?php endif; ?>
</ul>
</div>
<?php endif; ?>

    <?php if ($this->_tpl_vars['AUTHENTICATED']): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "themes/Sugar5/tpls/_headerLastViewed.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "themes/Sugar5/tpls/_headerShortcuts.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>