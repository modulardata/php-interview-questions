#!/usr/bin/perl -w

# convert-wav-to-ub: a script for converting your own
# letter sound files to the raw binary format used by
# the Boutell audio captcha. Hate my voice? Record your own!

# This Perl script requires the sox utility.
# For Red Hat Enterprise Linux, your admin
# can fetch it with: up2date sox

# For other systems see:
# http://sox.sourceforge.net/

# Usage:
# 1. Record .wav files of all of the letters of the alphabet
# 2. Call them a.wav, b.wav, etc. (note all lower case)
# 3. Run this script: perl convert-wav-to-ub.pl

# Copyright 2007, Boutell.Com, Inc. Permission granted to use
# this script as you see fit.

use strict;

my @wavs = glob("*.wav");

my $w;

for $w (@wavs) {
	if ($w =~ /^(\w)\.wav$/) {
		my $letter = $1;
		print "Processing $letter\n";
		system("sox $letter\.wav -r 22050 $letter\.ub");
	} 
}
 
