#!/usr/bin/env bash

if [[ $1 == -g || $1 == --gulp ]] ; then
    gulp --production
else
    echo No gulp
fi

rsync -avP dist lib screenshot.png templates *.php *.css mzoo:public_html/wpZoo/wp-content/themes/mZoo
