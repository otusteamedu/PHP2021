
## Home work 1

Notes on vagrant (on MacOS)

Install homestead with docs from laravel site

Then

1. Vagrant require allow access System Preferences -> Security and Privacy - Oracle America software . Then restart virtualbox.

2. Edit /etc/hosts for link ip 192.168.10.10 and homestead.test domain name

3. file on entry point in code/public should be named index.php otherwise will show 403 error

4. for ssh access create ssh keys with touch ~/.ssh/id_rsa
then ssh vagrant@127.0.0.1 -p 2222 
with password vagrant

5. run homestead.test in browser