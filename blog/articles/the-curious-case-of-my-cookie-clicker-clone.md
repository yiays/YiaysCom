Clicker (made in 2018) was a simple game inspired by Ortiel's Cookie Clicker with a few twists. It's built with Windows Forms and Visual Basic, which was a challenge and looks very interesting as a result. It was only ever intended to be a programming excercise in a new language, but in 2021, someone started sending through bug reports.

![](https://cdn.yiays.com/blog/cookie-clicker-changelog.webp)

> These bug reports resulted in quite a bit of work.

### The original release

In retrospect, v1.0 of the game, made in 2018, is heavily flawed. Understandibly so considering it was never really intended to be a finished or polished game, but more of a demonstration of my adaptability to unknown programming languages. I uploaded it to GitHub in 2020 as a part of my continued efforts to keep my code safe and built out my portfolio, the decision to include a build seems to have been the impotus for some random user to find the game and play it for fun.

They quickly found that several bugs related to counting were making it impossible to get far in the game and decided to reach out to me via email in an effort to get them fixed. I was a little surprised to see someone putting in so much effort over this game, but I worked with them to diagnose and fix a bunch of issues nonetheless.

### Updates

Here's a summary of changes made with each of the patches made this year.

#### V1.1

This version addressed some of the issues related to counting, I tried to track down everywhere numbers that tend to grow went (like balance) and made sure they're never converted to a smaller data type that can't hold bigger numbers. I also addressed a fatal flaw in the game, the fact that cookie boss fights (a unique mechanic) don't wait for the player to be ready. Considering this is meant to be at least somewhat idle friendly, this wasn't acceptible and I reworked the boss fight to wait for a player to declare that they're ready to fight.

#### V1.2

It only took a few hours for the game tester to discover that I hadn't completely eliminated the counting issues, so I decided to go all out and rework the entire model of the game with a MVVM architecture. This ensured that all functions that handle integers that tend to grow were in one place and by writing this element from scratch I could pay close attention to how variables are handled - especially when it comes to rendering them. I even went so far as to model out the game's economy on a graphing calculator and determine the limits of the game (the game should now only crash in the realms of thousands of levels).

#### V1.3

Autosaves were added in this update as a measure to improve the user experience in the event of a crash, alongside giving me the possibility to recreate the exact environment a player was in breifly before a crash. Naturally autosaves add a fair bit of complexity which I've accounted for. The warning that appears prompting you to save the game is now only present when the last autosave was a long time ago, and autosaves are disabled by default when loading a manual save. You can see some insight on this system in the stats tab. In addition, I added a custom currency formatter that abbreviates very large amounts of money into strings for rendering (very similar to the method used in the official Cookie Clicker).

### Conclusion

This project has been refreshing to revisit this year. It's of course much simpler than a lot of the programming work I do these days. I had a good time working with one user to triage and improve a game, even if I have no idea how they found it or how many others there are. They haven't reached out to me for a while so I suspect that they got as far as they wanted to in the game and stopped playing.

There's still some fundamental issues in the game that I might fix one day if I see evidence of people using it. Like making the game truly idle, infinitely scalable, and removing the possibility of soft-locks when users don't own any upgrades to sacrifice in the event of a boss fight. Ultimately fixing some of these issues might involve rethinking the entire gameplay loop though.

You can download the latest release [here](https://github.com/yiays/Cookie-Clicker/releases) if you're curious.