convert-wav-to-ub: a script for converting your own
letter sound files to the raw binary format used by
the Boutell audio captcha. 

Hate my voice? Record your own!

This Perl script requires the sox utility. On Red Hat Enterprise Linux, 
your admin can fetch it with: up2date sox

For other systems see:
http://sox.sourceforge.net/

Usage:
1. Record .wav files of all of the letters of the alphabet
2. Call them a.wav, b.wav, etc. (note all lower case)
3. Copy them to this directory
4. Run this script: perl convert-wav-to-ub.pl

This will replace my original .ub files with your own voice.

Copyright 2006, Boutell.Com, Inc. Permission granted to use
this script as you see fit.

