<?php /* Smarty version 2.6.11, created on 2012-12-06 17:25:41
         compiled from themes/Sugar5/tpls/_globalLinks.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getimage', 'themes/Sugar5/tpls/_globalLinks.tpl', 46, false),)), $this); ?>
<div id="globalLinks">
    <ul>
    <?php $_from = $this->_tpl_vars['GCLS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['gcl'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['gcl']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['gcl_key'] => $this->_tpl_vars['GCL']):
        $this->_foreach['gcl']['iteration']++;
?>
    <li>
    <?php if (! ($this->_foreach['gcl']['iteration'] <= 1)): ?><span>|</span><?php endif; ?>
    <a id="<?php echo $this->_tpl_vars['gcl_key']; ?>
_link" href="<?php echo $this->_tpl_vars['GCL']['URL']; ?>
"<?php if (! empty ( $this->_tpl_vars['GCL']['ONCLICK'] )): ?> onclick="<?php echo $this->_tpl_vars['GCL']['ONCLICK']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['GCL']['LABEL']; ?>
</a>
    <?php $_from = $this->_tpl_vars['GCL']['SUBMENU']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['gcl_submenu'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['gcl_submenu']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['gcl_submenu_key'] => $this->_tpl_vars['GCL_SUBMENU']):
        $this->_foreach['gcl_submenu']['iteration']++;
?>
    <?php if (($this->_foreach['gcl_submenu']['iteration'] <= 1)): ?>
    <?php echo smarty_function_sugar_getimage(array('name' => 'menuarrow','ext' => ".gif",'alt' => "",'other_attributes' => ''), $this);?>
<br />
    <ul class="cssmenu">
    <?php endif; ?>
    <li><a id="<?php echo $this->_tpl_vars['gcl_submenu_key']; ?>
_link" href="<?php echo $this->_tpl_vars['GCL_SUBMENU']['URL']; ?>
"<?php if (! empty ( $this->_tpl_vars['GCL_SUBMENU']['ONCLICK'] )): ?> onclick="<?php echo $this->_tpl_vars['GCL_SUBMENU']['ONCLICK']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['GCL_SUBMENU']['LABEL']; ?>
</a></li>
    <?php if (($this->_foreach['gcl_submenu']['iteration'] == $this->_foreach['gcl_submenu']['total'])): ?>
    </ul>
    <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    </li>
    <?php endforeach; endif; unset($_from); ?>
    </ul>
</div>