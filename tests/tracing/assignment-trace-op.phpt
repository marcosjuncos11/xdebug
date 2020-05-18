--TEST--
Test for tracing assign ops
--INI--
xdebug.mode=trace
xdebug.profiler_enable=0
xdebug.start_with_request=0
xdebug.trace_format=0
xdebug.collect_vars=1
xdebug.collect_params=4
xdebug.collect_return=0
xdebug.collect_assignments=1
--FILE--
<?php
$tf = xdebug_start_trace(sys_get_temp_dir() . '/'. uniqid('xdt', TRUE));

$a = 0;

$a += 42;
$a -= 2;
$a *= 2;
$a /= 5;
$a %= 4;
$a <<= 1;
$a >>= 3;
$a |= 0xffff;
$a &= 0xff0f;
$a ^= 0xf00f;
$a **= 2;

xdebug_stop_trace();
echo file_get_contents($tf);
unlink($tf);
?>
--EXPECTF--
TRACE START [%d-%d-%d %d:%d:%d]
                           => $tf = '%s.xt' %sassignment-trace-op.php:2
                           => $a = 0 %sassignment-trace-op.php:4
                           => $a += 42 %sassignment-trace-op.php:6
                           => $a -= 2 %sassignment-trace-op.php:7
                           => $a *= 2 %sassignment-trace-op.php:8
                           => $a /= 5 %sassignment-trace-op.php:9
                           => $a %= 4 %sassignment-trace-op.php:10
                           => $a <<= 1 %sassignment-trace-op.php:11
                           => $a >>= 3 %sassignment-trace-op.php:12
                           => $a |= 65535 %sassignment-trace-op.php:13
                           => $a &= 65295 %sassignment-trace-op.php:14
                           => $a ^= 61455 %sassignment-trace-op.php:15
                           => $a **= 2 %sassignment-trace-op.php:16
%w%f %w%d     -> xdebug_stop_trace() %sassignment-trace-op.php:18
%w%f %w%d
TRACE END   [%d-%d-%d %d:%d:%d]
