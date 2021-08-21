public::

TEMPLATES := $(shell find templates -maxdepth 6 -type f)
PAGES := $(shell find pages -type f -name '*.php')
CONFIG := $(shell find config -type f)

include make/*.mk

clean:
	rm -rf public/* schemas
