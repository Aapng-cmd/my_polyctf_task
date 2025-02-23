#!/bin/bash
find . -name README.md -exec sed -i 's/PolyCTF{[^}]*}/flag_plug/g' {} \;
find . -name *.txt -exec sed -i 's/PolyCTF{[^}]*}/flag_plug/g' {} \;
