PHP_FILES = $(shell grep -o 'DbUnit.*\.php' loader.php)

libphpunit-ext_u-4.4a.so: $(PHP_FILES)
	bpc -v \
		-c ../bpc-phpunit.phar-4.8.36/phpunit/phpunit.bpc.conf \
		-l phpunit-ext \
		-u phpunit \
		loader.php     \
		$(PHP_FILES)

install: libphpunit-ext_u-4.4a.so
	bpc -l phpunit-ext --install

clean:
	@rm -rf .bpc-build-* md5.map
	@rm -fv libphpunit-ext_u-4.4a.so libphpunit-ext_u-4.4a.a phpunit-ext.heap phpunit-ext.sch
