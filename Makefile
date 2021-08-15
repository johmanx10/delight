# Composer configuration
PHP := $(shell command -v php || echo php)
COMPOSER := $(shell command -v composer.phar || command -v composer || echo composer)
COMPOSER_VENDOR_DIR := $(shell $(COMPOSER) config vendor-dir || echo vendor)
COMPOSER_AUTOLOAD := $(shell echo "$(COMPOSER_VENDOR_DIR)/autoload.php")

CONVERT_OPTIONS=-strip

.PHONY: public
public::

# Install vendor dependencies.
$(COMPOSER_VENDOR_DIR) $(COMPOSER_AUTOLOAD): | composer.lock $(COMPOSER)
	$(COMPOSER) install

# Ensure one can always require 'vendor'
vendor: | $(COMPOSER_AUTOLOAD)

# Local application dependencies.
$(COMPOSER): | $(PHP)

# Update the lock file if the package file has changed.
composer.lock: composer.json | $(COMPOSER)
	$(COMPOSER) update && touch $@

public:: bin/build
	bin/build

public:: $(shell find config -type f)
public:: $(shell find pages -type f -name '*.php')
public:: $(shell find templates -maxdepth 6 -type f)
public:: composer.lock

public/img/favicons/favicon-%.png public/img/favicons/android-chrome-%.png public/img/logo-%.png: assets/logo.png
	@mkdir -p $(shell dirname $@)
	convert $^ $(CONVERT_OPTIONS) -quality 05 -resize $(*F) -density $(*F) $@

public/img/favicons/android-chrome-%.webp public/img/logo-%.webp: assets/logo.png
	@mkdir -p $(shell dirname $@)
	convert $^ $(CONVERT_OPTIONS) -resize $(*F) -density $(*F) $@

public:: public/img/logo-40x40.png
public:: public/img/logo-80x80.png
public:: public/img/logo-40x40.webp
public:: public/img/logo-80x80.webp

favicons:: public/img/favicons/favicon-16x16.png
favicons:: public/img/favicons/favicon-32x32.png

public/img/favicons/favicon.ico: assets/logo.png
	@mkdir -p $(shell dirname $@)
	convert $^ $(CONVERT_OPTIONS) -resize 128x128 -density 128x128 $@

favicons:: public/img/favicons/favicon.ico

public/img/favicons/apple-touch-icon.png: assets/logo.png
	@mkdir -p $(shell dirname $@)
	convert $^ $(CONVERT_OPTIONS) -resize 180x180 -density 180x180 $@

favicons:: public/img/favicons/apple-touch-icon.png
public/img/favicons/manifest.json: \
	bin/favicon-manifest \
	public/img/favicons/android-chrome-192x192.png \
	public/img/favicons/android-chrome-512x512.png \
	public/img/favicons/android-chrome-192x192.webp \
	public/img/favicons/android-chrome-512x512.webp
	@mkdir -p $(shell dirname $@)
	$^ > $@

favicons:: public/img/favicons/android-chrome-192x192.png
favicons:: public/img/favicons/android-chrome-512x512.png
favicons:: public/img/favicons/android-chrome-192x192.webp
favicons:: public/img/favicons/android-chrome-512x512.webp
favicons:: public/img/favicons/manifest.json

public:: | favicons

public/css/style.css: $(shell find assets/css -type f)
	@mkdir -p $(shell dirname $@)
	cat $^ | bin/minify-css > $@

css:: public/css/style.css

public:: | css

clean:
	rm -rf public/*
