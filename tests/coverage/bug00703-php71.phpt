--TEST--
Test for bug #703: Line in heredoc marked as not executed (<= PHP 7.1.3)
--SKIPIF--
<?php
require __DIR__ . '/../utils.inc';
check_reqs('PHP <= 7.1.3');
?>
--INI--
xdebug.mode=coverage
xdebug.trace_options=0
xdebug.collect_params=1
xdebug.collect_return=0
xdebug.collect_assignments=0
xdebug.auto_profile=0
xdebug.dump_globals=0
xdebug.show_mem_delta=0
xdebug.trace_format=0
xdebug.overload_var_dump=0
--FILE--
<?php
	xdebug_start_code_coverage(XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE);

	include 'bug00703.inc';
	$cc = xdebug_get_code_coverage();
	ksort($cc);
	var_dump(array_slice($cc, 1, 1));

	xdebug_stop_code_coverage(false);
?>
--EXPECTF--
array(1) {
  ["%sbug00703.inc"]=>
  array(6) {
    [3]=>
    int(1)
    [6]=>
    int(1)
    [7]=>
    int(1)
    [11]=>
    int(1)
    [12]=>
    int(1)
    [15]=>
    int(1)
  }
}
