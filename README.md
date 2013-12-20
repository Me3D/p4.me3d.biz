STORM CHAT

Team chat and target coordination for pentesting or Capture the Flag teams. Specifically for small teams, of no more than 10 or so in a private network. The target section is to list targets, and update as they are added/deleted/modded. Users should gain situational awareness in hectic events. The chat section allows for two levels of alerts. Ideally this setup would be running on a small server with full HTTPS, behind local firewalls, and as far away as possible from opposing teams.

Features:
1. Realtime target updating with a scrollable table.
2. Realtime chat with a smart scrollbar. It will not snap down during updates if one has scrolled up.
3. Chat alerts in different colors.
4. Latest chat alert is always in the center of screen.
5. Login with password.
6. Ability to change username and password. Will defend against duplicate usernames.
7. IRC styled slash commands in chat.
8. Can see when users were last seen ('/u' command).
9. Users can add/delete/modify targets.
10. Auto notifications of target being added/deleted, users logging in, and logging out.

Javascript:
1. All the modal dialogs are JQuery events to hidden Bootstrap modals.
2. Updates to the target and chat is via AJAX.
3. IRC slash commands.
4. Navbar menu items are added via JQuery.
5. Scrollbar smarts in chat.





