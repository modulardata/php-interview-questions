import sys
import os
import shutil

me_filename = 'mediaelement'
mep_filename = 'mediaelementplayer'
combined_filename = 'mediaelement-and-player'

# BUILD MediaElement (single file)

print('building MediaElement.js')
me_files = [
    'me-header.js',
    'me-namespace.js',
    'me-utility.js',
    'me-plugindetector.js',
    'me-featuredetection.js',
    'me-mediaelements.js',
    'me-shim.js',
    'me-i18n.js',
    'me-i18n-locale-de.js',
]
code = ''

for item in me_files:
	src_file = open(f'js/{item}', 'r')
	code += src_file.read() + "\n"

with open(f'../build/{me_filename}.js', 'w') as tmp_file:
	tmp_file.write(code)
# BUILD MediaElementPlayer (single file)
print('building MediaElementPlayer.js')
mep_files = [
    'mep-header.js',
    'mep-library.js',
    'mep-player.js',
    'mep-feature-playpause.js',
    'mep-feature-stop.js',
    'mep-feature-progress.js',
    'mep-feature-time.js',
    'mep-feature-volume.js',
    'mep-feature-fullscreen.js',
    'mep-feature-tracks.js',
    'mep-feature-contextmenu.js',
    'mep-feature-postroll.js',
]
# mep_files.append('mep-feature-sourcechooser.js')

code = ''

for item in mep_files:
	src_file = open(f'js/{item}', 'r')
	code += src_file.read() + "\n"

with open(f'../build/{mep_filename}.js', 'w') as tmp_file:
	tmp_file.write(code)
# MINIFY both scripts

print('Minifying JavaScript')
# os.system("java -jar yuicompressor-2.4.2.jar ../build/" + me_filename + ".js -o ../build/" + me_filename + ".min.js --charset utf-8 -v")
# os.system("java -jar yuicompressor-2.4.2.jar ../build/" + mep_filename + ".js -o ../build/" + mep_filename + ".min.js --charset utf-8 -v")
os.system(f'java -jar compiler.jar --js ../build/{me_filename}' +
          ".js --js_output_file ../build/" + me_filename + ".min.js")
os.system(f'java -jar compiler.jar --js ../build/{mep_filename}' +
          ".js --js_output_file ../build/" + mep_filename + ".min.js")

# PREPEND intros
def addHeader(headerFilename, filename):

	with open(headerFilename) as tmp_file:
		header_txt = tmp_file.read();
	with open(filename) as tmp_file:
		file_txt = tmp_file.read()
	with open(filename, 'w') as tmp_file:
		tmp_file.write(header_txt)
		# write the original contents
		tmp_file.write(file_txt)

addHeader('js/me-header.js', f'../build/{me_filename}.min.js')
addHeader('js/mep-header.js', f'../build/{mep_filename}.min.js')


# COMBINE into single script
print('Combining scripts')
code = ''
src_file = open(f'../build/{me_filename}.js', 'r')
code += src_file.read() + "\n"
src_file = open(f'../build/{mep_filename}.js', 'r')
code += src_file.read() + "\n"

with open(f'../build/{combined_filename}.js', 'w') as tmp_file:
	tmp_file.write(code)
code = ''
src_file = open(f'../build/{me_filename}.min.js', 'r')
code += src_file.read() + "\n"
src_file = open(f'../build/{mep_filename}.min.js', 'r')
code += src_file.read() + "\n"

with open(f'../build/{combined_filename}.min.js', 'w') as tmp_file:
	tmp_file.write(code)
# MINIFY CSS
print('Minifying CSS')
src_file = open('css/mediaelementplayer.css','r')
with open('../build/mediaelementplayer.css','w') as tmp_file:
	tmp_file.write(src_file.read())
os.system("java -jar yuicompressor-2.4.2.jar ../build/mediaelementplayer.css -o ../build/mediaelementplayer.min.css --charset utf-8 -v")

#COPY skin files
print('Copying Skin Files')
shutil.copy2('css/controls.png','../build/controls.png')
shutil.copy2('css/bigplay.png','../build/bigplay.png')
shutil.copy2('css/loading.gif','../build/loading.gif')

shutil.copy2('css/mejs-skins.css','../build/mejs-skins.css')
shutil.copy2('css/controls-ted.png','../build/controls-ted.png')
shutil.copy2('css/controls-wmp.png','../build/controls-wmp.png')
shutil.copy2('css/controls-wmp-bg.png','../build/controls-wmp-bg.png')

print('DONE!')
