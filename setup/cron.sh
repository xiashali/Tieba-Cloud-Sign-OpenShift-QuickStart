#!/bin/sh
chmod +x do.sh
chmod +x restart.sh
cp ./*.sh ../.openshift/cron/minutely
rm -R ../setup