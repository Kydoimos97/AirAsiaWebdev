<div align="center">
# AirAsia Website
_Created for IS6465 at the University of Utah

[![discord badge]][discord link]

[![latest release badge]][latest release link] [![github stars badge]][github stars link] [![github forks badge]][github forks link]

[![CI checks on main badge]][CI checks on main link] [![CI checks on dev badge]][CI checks on dev link] [![latest commit to dev badge]][latest commit to dev link]

[![github open issues badge]][github open issues link] [![github open prs badge]][github open prs link]

[CI checks on dev badge]: https://flat.badgen.net/github/checks/invoke-ai/InvokeAI/development?label=CI%20status%20on%20dev&cache=900&icon=github
[CI checks on dev link]: https://github.com/invoke-ai/InvokeAI/actions?query=branch%3Adevelopment
[CI checks on main badge]: https://flat.badgen.net/github/checks/invoke-ai/InvokeAI/main?label=CI%20status%20on%20main&cache=900&icon=github
[CI checks on main link]: https://github.com/invoke-ai/InvokeAI/actions/workflows/test-invoke-conda.yml
[discord badge]: https://flat.badgen.net/discord/members/ZmtBAhwWhy?icon=discord
[discord link]: https://discord.gg/ZmtBAhwWhy
[github forks badge]: https://flat.badgen.net/github/forks/invoke-ai/InvokeAI?icon=github
[github forks link]: https://useful-forks.github.io/?repo=invoke-ai%2FInvokeAI
[github open issues badge]: https://flat.badgen.net/github/open-issues/invoke-ai/InvokeAI?icon=github
[github open issues link]: https://github.com/invoke-ai/InvokeAI/issues?q=is%3Aissue+is%3Aopen
[github open prs badge]: https://flat.badgen.net/github/open-prs/invoke-ai/InvokeAI?icon=github
[github open prs link]: https://github.com/invoke-ai/InvokeAI/pulls?q=is%3Apr+is%3Aopen
[github stars badge]: https://flat.badgen.net/github/stars/invoke-ai/InvokeAI?icon=github
[github stars link]: https://github.com/invoke-ai/InvokeAI/stargazers
[latest commit to dev badge]: https://flat.badgen.net/github/last-commit/invoke-ai/InvokeAI/development?icon=github&color=yellow&label=last%20dev%20commit&cache=900
[latest commit to dev link]: https://github.com/invoke-ai/InvokeAI/commits/development
[latest release badge]: https://flat.badgen.net/github/release/invoke-ai/InvokeAI/development?icon=github
[latest release link]: https://github.com/invoke-ai/InvokeAI/releases
</div>

# VERSION INFO
PHP DEVELOPMENT VERSION: 8.0
CLI = 8.1.0
Bootstrap versions 3.7, 4.1
----------------------


# DB INFO
To create the database run the SQL files in this order:

1. sqlUsers.sql
2. sqlCard.sql
3. phpImage.php
4. sqlCart.sql
5. sqlRedemption.sql

After that some database tables can be reset from the admin page which can be accessed when logged in as the admin user.
----------------------

#LOGIN INFO
There are four default users with [username - password - role]
1. admin - admin - admin
2. msis@utah.edu - root - user
3. bsmith - mysecret - admin
4. pjones - acrobat - user

Passwords are stored in hashes, so they can't simply be read or updated directly in the database.
----------------------

#MISC INFO
Card updates and editing can be accessed from the edit glyphicon on the cardlist and carddetail pages.
----------------------


#REQUIREMENTS
1. Log in to the system and show the list of gift cards (5 pt). Use password_verify to validate the password.
------Done, The cards can be accessed from the side menu

2. Add session management to the system (5 pt). This means users cannot access any page (except login.php) unless they are logged in. Log the user out of the system.
------Done all pages need logins or privileges except for flights, index and login

3. Add authorization to control user access to pages (5 pt).
------Done user cannot edit cards or add new cards or go to the admin panel

4. Add a new customer (cust-add.php) (5 pt). Customer is synonymous with User. Use password_hash to hash the password and insert it into the USER DB table.
------Done But users create own account and are referred to as users.

5. Add the new USER database table. Connect the PHP page to DB. (5 pt)
------Done

6. Add pages to allow users to redeem gift cards. (Extra credit 5 pts). The use case must deduct points from the user account and insert a new row into the Redemption table.
------Done

7. Organize your code in respective folders if needed. -
------Done

8. Use the default usernames and passwords for testing your application
------Done
