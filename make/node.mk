NPM := $(shell command -v npm || which npm || echo npm)
SVGS := \
	outline/phone.svg \
	solid/phone.svg \
	outline/mail.svg \
	outline/menu.svg \
	outline/external-link.svg \
	outline/x.svg

node_modules/.package-lock.json: package.json | $(NPM)
	$(NPM) install

node_modules: node_modules/.package-lock.json

public:: | node_modules

public/img/svg/%: node_modules
	@mkdir -p $(@D)
	cp node_modules/heroicons/$* $@

svg: $(SVGS:%.svg=public/img/svg/%.svg)

public:: | svg
