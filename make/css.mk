CSS := $(shell find assets/css -type f)

public/css/style.css: $(CSS) | svg bin/minify-css vendor
	@mkdir -p $(shell dirname $@)
	cat $^ | bin/minify-css > $@

css:: public/css/style.css

public:: | css
