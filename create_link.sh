###########
# Only needed to init; not needed after cloning
# mkdir cse340 # create a dir for the class
# cd cse340 # go into dir
# git init # init repository
###########

mv /Applications/XAMPP/xamppfiles/htdocs /Applications/XAMPP/xamppfiles/_htdocs_bkp/ # make a copy in case I screw it up...
cp -r /Applications/XAMPP/xamppfiles/_htdocs_bkp/* . # move contents into class dir
echo dashboard >> .gitignore # ignore the dashboard; I don't know what you're for yet...

###########
# These do the cleanup, skip this if you've already done it manually.
rm -rf webalizer favicon.ico index.php
mv applications.html bitnami.css img dashboard
###########

ln -s $(pwd) /Applications/XAMPP/xamppfiles/htdocs # create the link
