CONVERT_OPTIONS=-strip

public/img/favicons/favicon-%.png public/img/favicons/android-chrome-%.png public/img/logo-%.png: assets/logo.png
	@mkdir -p $(@D)
	convert $^ $(CONVERT_OPTIONS) -quality 05 -resize $(*F) -density $(*F) $@

public/img/favicons/android-chrome-%.webp public/img/logo-%.webp: assets/logo.png
	@mkdir -p $(@D)
	convert $^ $(CONVERT_OPTIONS) -resize $(*F) -density $(*F) $@

public:: public/img/logo-40x40.png
public:: public/img/logo-64x64.png
public:: public/img/logo-80x80.png
public:: public/img/logo-40x40.webp
public:: public/img/logo-64x64.webp
public:: public/img/logo-80x80.webp

favicons:: public/img/favicons/favicon-16x16.png
favicons:: public/img/favicons/favicon-32x32.png

public/img/shields/cat-%.png: assets/CAT.png
	@mkdir -p $(@D)
	convert $^ $(CONVERT_OPTIONS) -quality 05 -resize $(*F) -density $(*F) $@

public/img/shields/gat-%.png: assets/GAT.png
	@mkdir -p $(@D)
	convert $^ $(CONVERT_OPTIONS) -quality 05 -resize $(*F) -density $(*F) $@

public/img/shields/cat-%.webp: assets/CAT.png
	@mkdir -p $(@D)
	convert $^ $(CONVERT_OPTIONS) -resize $(*F) -density $(*F) $@

public/img/shields/gat-%.webp: assets/GAT.png
	@mkdir -p $(@D)
	convert $^ $(CONVERT_OPTIONS) -resize $(*F) -density $(*F) $@

shields:: public/img/shields/cat-118x117.png
shields:: public/img/shields/cat-236x234.png
shields:: public/img/shields/gat-114x106.png
shields:: public/img/shields/gat-228x212.png
shields:: public/img/shields/cat-118x117.webp
shields:: public/img/shields/cat-236x234.webp
shields:: public/img/shields/gat-114x106.webp
shields:: public/img/shields/gat-228x212.webp

public:: | shields

public/img/favicons/favicon.ico: assets/logo.png
	@mkdir -p $(@D)
	convert $^ $(CONVERT_OPTIONS) -resize 128x128 -density 128x128 $@

favicons:: public/img/favicons/favicon.ico

public/img/favicons/apple-touch-icon.png: assets/logo.png
	@mkdir -p $(@D)
	convert $^ $(CONVERT_OPTIONS) -resize 180x180 -density 180x180 $@

favicons:: public/img/favicons/apple-touch-icon.png
public/img/favicons/manifest.json: \
	bin/favicon-manifest \
	public/img/favicons/android-chrome-192x192.png \
	public/img/favicons/android-chrome-512x512.png \
	public/img/favicons/android-chrome-192x192.webp \
	public/img/favicons/android-chrome-512x512.webp \
	templates/pages/img/favicons/manifest.json.twig \
	$(CONFIG)
	@mkdir -p $(@D)
	bin/favicon-manifest public/img/favicons/android-chrome-*.* > $@

favicons:: public/img/favicons/android-chrome-192x192.png
favicons:: public/img/favicons/android-chrome-512x512.png
favicons:: public/img/favicons/android-chrome-192x192.webp
favicons:: public/img/favicons/android-chrome-512x512.webp
favicons:: public/img/favicons/manifest.json

public:: | favicons
