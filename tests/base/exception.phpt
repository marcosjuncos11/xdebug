--TEST--
Test to see if exceptions still work with Xdebug's hook enabled
--INI--
xdebug.mode=display
xdebug.auto_trace=0
xdebug.collect_params=0
xdebug.show_mem_delta=0
xdebug.profiler_enable=0
--FILE--
<?php

class FooException extends Exception {
}

function a() {
	try {
		throw new FooException('foo');
	} catch (Exception $e) {
		echo "Caught\n";
	}
}

a();
?>
--EXPECT--
Caught
