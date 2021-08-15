HTML := $(shell bin/build-targets)

$(HTML):: vendor $(PAGES) $(TEMPLATES) $(CONFIG)
	bin/build

html: $(HTML)
public:: | html
