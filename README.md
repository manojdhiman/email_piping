# email_piping



Postfix can easily be installed through apt-get:

#sudo apt-get install postfix

During the installation, you will see a dialogue box appear, asking you which kind of installation you would prefer. Select “Internet Site”.

Follow up by entering the name of your domain.

Once Postfix is installed there are a few steps that need to be taken before it is fully functional.
Configure Postfix

Once Postfix is installed, go ahead and open the main configuration file.

#sudo nano /etc/postfix/main.cf

There are a few changes that should be made in this file.

#myhostname = example.com

Put in name of your domain into myhostname.

If you want to have mail forwarded to other domains, replace alias_maps with virtual_alias_maps and point it to /etc/postfix/virtual.

#virtual_alias_maps = hash:/etc/postfix/virtual

The rest of the entries are described below

mydestination defines the domains that postfix is going to serve, in this case—localhost and your domain (eg. example.com). relayhost can be left, as is the default, empty.

mynetworks defines who can use the mail server. This should be set to local—creating an open mail server is asking for SPAM. This will usually have damaging effects on your server and may put you in line for discipline from your web hosting provider.

If it is not set up by default, as it should be, make sure you have the following text on that line:

#mynetworks = 127.0.0.0/8 [::ffff:127.0.0.0]/104 [::1]/128

The rest of the lines are set by default. Save, exit, and reload the configuration file to put your changes into effect:

#sudo /etc/init.d/postfix reload

Configure Additional Emails

To redirect emails to specific emails, you can add users to the alias file. By default each user on the server will be able to read emails directed to their username@domain-name.com.

Open up the the alias database:

#sudo nano /etc/postfix/virtual

Within that file, enter in the names of your users. For example:

#sales@example.com username1
#me@example.com username2

Once you are finished, save, exit, and run the following command:

#postmap /etc/postfix/virtual

The last step is to reload postfix once more.

#sudo /etc/init.d/postfix reload
