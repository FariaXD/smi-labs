#!/bin/bash

#
# r is the rate in Hz
#
# 0.0166 ~= 1 / 60 (one frame per minute)
#

/usr/local/bin/ffmpeg -i BigBuckBunny.mp4 -r 0.5 -s 80*80 -f image2 sprites/thumb-%03d.jpg
