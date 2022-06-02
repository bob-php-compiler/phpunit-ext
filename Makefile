PHP_FILES = $(shell grep -o 'DbUnit.*\.php' loader.php)

libphpunit-ext_u-4.4a.so: $(PHP_FILES)
	bpc -l phpunit-ext \
        -u phpunit \
        loader.php     \
        $(PHP_FILES)

install: libphpunit-ext_u-4.4a.so
	bpc -l phpunit-ext --install

clean:
	@rm -rf .bpc-build-* md5.map
	@rm -fv libphpunit-ext_u-4.4a.so libphpunit-ext_u-4.4a.a phpunit-ext.heap phpunit-ext.sch

test: run-test.php test-files
	bpc -u phpunit \
        -u phpunit-ext \
        -d display_errors=on \
        run-test.php \
        --input-file test-files
