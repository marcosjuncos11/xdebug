--TEST--
Test for bug #212: coverage coverage inaccurate (2)
--INI--
xdebug.mode=coverage
xdebug.auto_trace=0
xdebug.trace_options=0
xdebug.collect_params=1
xdebug.collect_return=0
xdebug.auto_profile=0
xdebug.profiler_enable=0
xdebug.dump_globals=0
xdebug.show_mem_delta=0
xdebug.trace_format=0
xdebug.overload_var_dump=0
--FILE--
<?php
	xdebug_start_code_coverage( XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE );
	$file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'bug00212-002.inc';
	include $file;
	$cc = xdebug_get_code_coverage();
	xdebug_stop_code_coverage();
	var_dump($cc[$file]);
?>
--EXPECT--
array(3) {
  [7]=>
  int(1)
  [9]=>
  int(1)
  [11]=>
  int(1)
}
