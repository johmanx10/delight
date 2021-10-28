HTML := $(shell bin/build-targets)
PHP_SOURCE := $(shell find src -type f)

$(HTML):: vendor $(PAGES) $(TEMPLATES) $(CONFIG) $(PHP_SOURCE) public/css/style.css | favicons
	bin/build

html: $(HTML)
public:: | html

schemas/sitemap.xsd:
	@mkdir -p "$(@D)"
	curl -fL http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd > $@

public/sitemap.xml: $(HTML) schemas/sitemap.xsd
	bin/sitemap > $@

sitemap: public/sitemap.xml

public:: | sitemap

public/robots.txt: public/sitemap.xml
	echo "Sitemap: $(shell php -r 'require "config/config.php"; echo WEBSITE;')/$(^F)" > $@

robots: public/robots.txt

public:: | robots
