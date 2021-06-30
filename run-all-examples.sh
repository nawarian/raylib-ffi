#!/bin/sh

for f in $(find examples -name '*.php'); do
    php $f;
done

